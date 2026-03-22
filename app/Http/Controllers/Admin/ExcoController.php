<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exco;
use App\Models\ExcoTenor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ExcoController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = __('Manage Excos');
        $data['activeExcos'] = 'active';
        $tenor_id = $request->get('tenor_id');
        
        $query = Exco::tenant()->with('tenor');
        if ($tenor_id) {
            $query->where('exco_tenor_id', $tenor_id);
        }
        
        $data['excos'] = $query->orderBy('order', 'asc')->orderBy('created_at', 'desc')->paginate(15);
        $data['tenors'] = ExcoTenor::tenant()->orderBy('start_date', 'desc')->get();
        $data['selected_tenor'] = $tenor_id;

        return view('admin.excos.members.index', $data);
    }

    public function create()
    {
        $data['title'] = __('Add Exco');
        $data['activeExcos'] = 'active';
        $data['tenors'] = ExcoTenor::tenant()->orderBy('start_date', 'desc')->get();
        return view('admin.excos.members.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'exco_tenor_id' => 'required|exists:exco_tenors,id',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'order' => 'integer',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->except(['_token', 'photo']);
        $data['tenant_id'] = function_exists('getTenantId') ? getTenantId() : null;
        $data['created_by'] = auth()->id();
        $data['status'] = $request->has('status') && $request->status == 'active' ? 1 : 0;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/excos'), $filename);
            $data['photo'] = 'uploads/excos/' . $filename;
        }

        Exco::create($data);

        return redirect()->route('admin.excos.index', ['tenor_id' => $request->exco_tenor_id])->with('success', __('Exco added successfully.'));
    }

    public function edit($id)
    {
        $data['title'] = __('Edit Exco');
        $data['activeExcos'] = 'active';
        $data['exco'] = Exco::tenant()->findOrFail($id);
        $data['tenors'] = ExcoTenor::tenant()->orderBy('start_date', 'desc')->get();
        return view('admin.excos.members.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $exco = Exco::tenant()->findOrFail($id);

        $request->validate([
            'exco_tenor_id' => 'required|exists:exco_tenors,id',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'order' => 'integer',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->except(['_token', 'photo']);
        $data['status'] = $request->has('status') && $request->status == 'active' ? 1 : 0;

        if ($request->hasFile('photo')) {
            // Remove old photo
            if ($exco->photo && file_exists(public_path($exco->photo))) {
                unlink(public_path($exco->photo));
            }

            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/excos'), $filename);
            $data['photo'] = 'uploads/excos/' . $filename;
        }

        $exco->update($data);

        return redirect()->route('admin.excos.index', ['tenor_id' => $request->exco_tenor_id])->with('success', __('Exco updated successfully.'));
    }

    public function destroy($id)
    {
        $exco = Exco::tenant()->findOrFail($id);
        if ($exco->photo && file_exists(public_path($exco->photo))) {
            unlink(public_path($exco->photo));
        }
        $exco->delete();

        return response()->json(['message' => __('Exco deleted successfully.'), 'success' => true]);
    }
}
