@extends('layouts.app')
@push('title')
    {{ $title }}
@endpush
@section('content')
    <style>
        .report-panel {
            background-color: var(--bg-primary, #0B0E11);
            min-height: 100vh;
            padding: 30px;
        }

        .report-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .report-title {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 600;
            color: #fff;
        }

        .report-title i {
            color: var(--gold, #D4AF5A);
            margin-right: 12px;
        }

        .header-actions {
            display: flex;
            gap: 10px;
        }

        .btn-back,
        .btn-export {
            background: transparent;
            border: 1px solid var(--border-dark, #1F2630);
            color: var(--text-secondary, #B4BCC8);
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-back:hover,
        .btn-export:hover {
            border-color: var(--gold, #D4AF5A);
            color: var(--gold, #D4AF5A);
        }

        .btn-export {
            background: linear-gradient(135deg, var(--gold, #D4AF5A), #B8934A);
            color: #000;
            border: none;
        }

        .btn-export:hover {
            color: #000;
        }

        .stats-bar {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        @media (max-width: 991px) {
            .stats-bar {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .stat-card {
            background: var(--bg-surface, #12161C);
            border: 1px solid var(--border-dark, #1F2630);
            border-radius: 12px;
            padding: 20px;
            text-align: center;
        }

        .stat-card-value {
            font-size: 36px;
            font-weight: 700;
            color: var(--gold, #D4AF5A);
        }

        .stat-card-value.success {
            color: #22C55E;
        }

        .stat-card-value.warning {
            color: #F59E0B;
        }

        .stat-card-label {
            font-size: 14px;
            color: var(--text-secondary, #B4BCC8);
        }

        .report-table-container {
            background: var(--bg-surface, #12161C);
            border: 1px solid var(--border-dark, #1F2630);
            border-radius: 16px;
            overflow: hidden;
        }

        .report-table {
            width: 100%;
            border-collapse: collapse;
        }

        .report-table th {
            background: var(--bg-elevated, #171C23);
            color: var(--text-secondary, #B4BCC8);
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            padding: 16px 20px;
            text-align: left;
            border-bottom: 1px solid var(--border-dark, #1F2630);
        }

        .report-table td {
            color: #fff;
            padding: 16px 20px;
            border-bottom: 1px solid var(--border-dark, #1F2630);
        }

        .report-table tr:last-child td {
            border-bottom: none;
        }

        .report-table tr:hover td {
            background: rgba(212, 175, 90, 0.05);
        }

        .user-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--gold, #D4AF5A);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #000;
            font-size: 14px;
        }

        .user-name {
            font-weight: 500;
        }

        .user-email {
            font-size: 13px;
            color: var(--text-secondary, #B4BCC8);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-badge.checked-in {
            background: rgba(34, 197, 94, 0.15);
            color: #22C55E;
        }

        .status-badge.no-show {
            background: rgba(239, 68, 68, 0.15);
            color: #EF4444;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-secondary, #B4BCC8);
        }
    </style>

    <div class="report-panel">
        <div class="report-header">
            <h1 class="report-title">
                <i class="bi bi-file-earmark-text"></i>{{ $event->title }} - {{ __('Attendance Report') }}
            </h1>
            <div class="header-actions">
                <a href="{{ route('admin.event-check-in.index') }}" class="btn-back">
                    <i class="bi bi-arrow-left"></i> {{ __('Back') }}
                </a>
                <a href="{{ route('admin.event-check-in.export', $event->id) }}" class="btn-export">
                    <i class="bi bi-download"></i> {{ __('Export CSV') }}
                </a>
            </div>
        </div>

        <div class="stats-bar">
            <div class="stat-card">
                <div class="stat-card-value">{{ $stats['total'] }}</div>
                <div class="stat-card-label">{{ __('Total Tickets') }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-card-value success">{{ $stats['checked_in'] }}</div>
                <div class="stat-card-label">{{ __('Checked In') }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-card-value warning">{{ $stats['no_show'] }}</div>
                <div class="stat-card-label">{{ __('No Show') }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-card-value">{{ $stats['attendance_rate'] }}%</div>
                <div class="stat-card-label">{{ __('Attendance Rate') }}</div>
            </div>
        </div>

        <div class="report-table-container">
            @if($tickets->count() > 0)
                <table class="report-table">
                    <thead>
                        <tr>
                            <th>{{ __('Ticket #') }}</th>
                            <th>{{ __('Attendee') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Checked In At') }}</th>
                            <th>{{ __('Checked In By') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tickets as $ticket)
                            <tr>
                                <td>
                                    <code style="color: var(--gold);">{{ $ticket->ticket_number }}</code>
                                </td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar">
                                            {{ strtoupper(substr($ticket->user->name ?? 'U', 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="user-name">{{ $ticket->user->name ?? 'Unknown' }}</div>
                                            <div class="user-email">{{ $ticket->user->email ?? '' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($ticket->isCheckedIn())
                                        <span class="status-badge checked-in">
                                            <i class="bi bi-check-circle-fill"></i> {{ __('Checked In') }}
                                        </span>
                                    @else
                                        <span class="status-badge no-show">
                                            <i class="bi bi-x-circle-fill"></i> {{ __('No Show') }}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if($ticket->checked_in_at)
                                        {{ $ticket->checked_in_at->format('M d, Y h:i A') }}
                                    @else
                                        <span style="color: var(--text-secondary);">—</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $ticket->checkedInByUser->name ?? '—' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <i class="bi bi-ticket-perforated" style="font-size: 40px; color: var(--gold);"></i>
                    <h4>{{ __('No tickets found') }}</h4>
                </div>
            @endif
        </div>
    </div>
@endsection