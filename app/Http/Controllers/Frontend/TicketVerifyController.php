<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\EventTicket;
use Exception;

class TicketVerifyController extends Controller
{
    public function ticketPreview($ticket)
    {
        try{
            $ticketId = decrypt($ticket);
            $data['ticket'] = EventTicket::where('ticket_number', $ticketId)->with('user.alumni')->first();
            $data['success'] = true;
        }catch(Exception $e){
            $data['success'] = false;
        }

        return view('frontend.events.validate-ticket', $data);
    }
}
