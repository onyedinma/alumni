<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventTicket;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;

class EventCheckInController extends Controller
{
    use ResponseTrait;

    /**
     * List events with check-in stats
     */
    public function index()
    {
        $data['title'] = __('Event Check-In');
        $data['activeEventCheckIn'] = 'active';

        $data['events'] = Event::tenant()
            ->withCount([
                'eventTickets',
                'eventTickets as checked_in_count' => function ($q) {
                    $q->whereNotNull('checked_in_at');
                }
            ])
            ->where('date', '>=', now()->subMonth())
            ->orderByDesc('date')
            ->get();

        return view('admin.events.check-in.index', $data);
    }

    /**
     * Show scanner interface for specific event
     */
    public function scan(Event $event)
    {
        $data['title'] = __('Check-In Scanner');
        $data['activeEventCheckIn'] = 'active';
        $data['event'] = $event;

        $data['stats'] = [
            'total' => $event->eventTickets()->count(),
            'checked_in' => $event->eventTickets()->checkedIn()->count(),
            'pending' => $event->eventTickets()->notCheckedIn()->count(),
        ];

        $data['recentCheckins'] = $event->eventTickets()
            ->checkedIn()
            ->with(['user', 'checkedInByUser'])
            ->orderByDesc('checked_in_at')
            ->take(10)
            ->get();

        return view('admin.events.check-in.scan', $data);
    }

    /**
     * Process check-in via ticket number
     */
    public function checkIn(Request $request)
    {
        $request->validate([
            'ticket_number' => 'required|string',
            'event_id' => 'required|exists:events,id',
        ]);

        $ticket = EventTicket::where('ticket_number', $request->ticket_number)
            ->where('event_id', $request->event_id)
            ->with(['user', 'event'])
            ->first();

        if (!$ticket) {
            return $this->error([], __('Ticket not found for this event'));
        }

        if ($ticket->isCheckedIn()) {
            return $this->error([
                'already_checked_in' => true,
                'checked_in_at' => $ticket->checked_in_at->format('M d, Y h:i A'),
                'user_name' => $ticket->user->name ?? 'Unknown',
            ], __('This ticket has already been checked in'));
        }

        $ticket->checkIn(auth()->id());

        return $this->success([
            'ticket' => [
                'number' => $ticket->ticket_number,
                'user_name' => $ticket->user->name ?? 'Unknown',
                'user_email' => $ticket->user->email ?? '',
                'checked_in_at' => $ticket->fresh()->checked_in_at->format('M d, Y h:i A'),
            ],
        ], __('Successfully checked in!'));
    }

    /**
     * Attendance report for event
     */
    public function report(Event $event)
    {
        $data['title'] = __('Attendance Report');
        $data['activeEventCheckIn'] = 'active';
        $data['event'] = $event;

        $data['tickets'] = $event->eventTickets()
            ->with(['user', 'checkedInByUser'])
            ->orderByDesc('checked_in_at')
            ->orderByDesc('created_at')
            ->get();

        $data['stats'] = [
            'total' => $data['tickets']->count(),
            'checked_in' => $data['tickets']->filter->isCheckedIn()->count(),
            'no_show' => $data['tickets']->filter(fn($t) => !$t->isCheckedIn())->count(),
            'attendance_rate' => $data['tickets']->count() > 0
                ? round(($data['tickets']->filter->isCheckedIn()->count() / $data['tickets']->count()) * 100, 1)
                : 0,
        ];

        return view('admin.events.check-in.report', $data);
    }

    /**
     * Export attendance to CSV
     */
    public function export(Event $event)
    {
        $tickets = $event->eventTickets()
            ->with(['user'])
            ->orderBy('checked_in_at')
            ->get();

        $filename = 'attendance_' . str_replace(' ', '_', $event->title) . '_' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($tickets) {
            $file = fopen('php://output', 'w');

            // Headers
            fputcsv($file, ['Ticket #', 'Name', 'Email', 'Status', 'Checked In At', 'Checked In By']);

            foreach ($tickets as $ticket) {
                fputcsv($file, [
                    $ticket->ticket_number,
                    $ticket->user->name ?? 'N/A',
                    $ticket->user->email ?? 'N/A',
                    $ticket->isCheckedIn() ? 'Checked In' : 'No Show',
                    $ticket->checked_in_at ? $ticket->checked_in_at->format('Y-m-d H:i:s') : '',
                    $ticket->checkedInByUser->name ?? '',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
