<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ExcoTenor;
use App\Models\Exco;
use Illuminate\Http\Request;

class ExcoController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = __('Executive Committee');
        
        $tenors = ExcoTenor::tenant()->orderBy('start_date', 'desc')->get();
        $selectedTenor = null;
        
        if ($request->has('tenor_id')) {
            $selectedTenor = $tenors->where('id', $request->tenor_id)->first();
        } else {
            $selectedTenor = $tenors->where('is_current', true)->first() ?? $tenors->first();
        }
        
        $excos = collect();
        if ($selectedTenor) {
            $excos = Exco::tenant()
                ->where('exco_tenor_id', $selectedTenor->id)
                ->where('status', 1)
                ->orderBy('order', 'asc')
                ->get();
        }
        
        $data['tenors'] = $tenors;
        $data['selectedTenor'] = $selectedTenor;
        $data['excos'] = $excos;
        
        return view('frontend.excos', $data);
    }
}
