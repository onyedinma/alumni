<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExcoTenor;
use Illuminate\Http\Request;

class ExcoTenorController extends Controller
{
    public function index()
    {
        $data['title'] = __('Manage Exco Tenors');
        $data['activeExcos'] = 'active';
        $data['tenors'] = ExcoTenor::tenant()->orderBy('start_date', 'desc')->paginate(10);
        return view('admin.excos.tenors.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $data = $request->only(['title', 'start_date', 'end_date']);
        $data['tenant_id'] = function_exists('getTenantId') ? getTenantId() : null;
        $data['created_by'] = auth()->id();
        
        // If this is set as current, unset others
        if ($request->has('is_current')) {
            ExcoTenor::tenant()->update(['is_current' => false]);
            $data['is_current'] = true;
        } else {
            // if it's the first tenor, make it current automatically
            if (ExcoTenor::tenant()->count() === 0) {
                $data['is_current'] = true;
            } else {
                $data['is_current'] = false;
            }
        }

        ExcoTenor::create($data);

        return redirect()->route('admin.exco-tenors.index')->with('success', __('Exco Tenor created successfully.'));
    }

    public function update(Request $request, $id)
    {
        $tenor = ExcoTenor::tenant()->findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $data = $request->only(['title', 'start_date', 'end_date']);
        
        if ($request->has('is_current')) {
            ExcoTenor::tenant()->where('id', '!=', $id)->update(['is_current' => false]);
            $data['is_current'] = true;
        } else {
            // Cannot unset current if it is the only one
            $data['is_current'] = false;
        }

        $tenor->update($data);

        return redirect()->route('admin.exco-tenors.index')->with('success', __('Exco Tenor updated successfully.'));
    }

    public function destroy($id)
    {
        $tenor = ExcoTenor::tenant()->findOrFail($id);
        $tenor->delete();

        return response()->json(['message' => __('Exco Tenor deleted successfully.'), 'success' => true]);
    }
}
