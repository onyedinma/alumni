<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HallOfFame;

class HallOfFameController extends Controller
{
    /**
     * Display public Hall of Fame page.
     */
    public function index()
    {
        $data['title'] = __('Hall of Fame');
        $data['entries'] = HallOfFame::tenant()
            ->active()
            ->orderByDesc('year_inducted')
            ->orderByDesc('is_featured')
            ->paginate(12);
        $data['categories'] = HallOfFame::categories();
        $data['featuredEntries'] = HallOfFame::tenant()
            ->active()
            ->featured()
            ->orderByDesc('year_inducted')
            ->take(3)
            ->get();

        return view('frontend.hall-of-fame.index', $data);
    }
}
