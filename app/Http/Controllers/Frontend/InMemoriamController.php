<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\InMemoriam;

class InMemoriamController extends Controller
{
    /**
     * Display the public In Memoriam page.
     */
    public function index()
    {
        $data['title'] = __('In Memoriam');
        $data['entries'] = InMemoriam::where('tenant_id', getTenantId())
            ->where('is_approved', true)
            ->orderByDesc('date_of_passing')
            ->get();

        return view('frontend.in_memoriam', $data);
    }
}
