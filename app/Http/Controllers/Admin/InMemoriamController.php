<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InMemoriam;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class InMemoriamController extends Controller
{
    use ResponseTrait;

    /**
     * Display all In Memoriam entries.
     */
    public function index()
    {
        $data['title'] = __('In Memoriam');
        $data['activeInMemoriam'] = 'active';
        $data['entries'] = InMemoriam::tenant()
            ->with(['creator'])
            ->orderByDesc('date_of_passing')
            ->paginate(20);

        return view('admin.in-memoriam.index', $data);
    }

    /**
     * Show form for creating new entry.
     */
    public function create()
    {
        $data['title'] = __('Add Memorial');
        $data['activeInMemoriam'] = 'active';
        return view('admin.in-memoriam.create', $data);
    }

    /**
     * Store a new entry.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date_of_passing' => 'required|date',
            'photo' => 'nullable|image|max:2048',
            'graduation_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'obituary' => 'nullable|string',
            'tribute' => 'nullable|string',
        ]);

        $data = $request->only([
            'name',
            'graduation_year',
            'date_of_birth',
            'date_of_passing',
            'obituary',
            'tribute',
            'house',
            'class_arm'
        ]);
        $data['tenant_id'] = getTenantId();
        $data['created_by'] = auth()->id();
        $data['is_approved'] = true;
        $data['approved_by'] = auth()->id();

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/in-memoriam'), $filename);
            $data['photo'] = 'uploads/in-memoriam/' . $filename;
        }

        InMemoriam::create($data);

        return redirect()->route('admin.in-memoriam.index')
            ->with('success', __('Memorial entry added successfully.'));
    }

    /**
     * Show form for editing entry.
     */
    public function edit($id)
    {
        $data['title'] = __('Edit Memorial');
        $data['activeInMemoriam'] = 'active';
        $data['entry'] = InMemoriam::tenant()->findOrFail($id);
        return view('admin.in-memoriam.edit', $data);
    }

    /**
     * Update an entry.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date_of_passing' => 'required|date',
            'photo' => 'nullable|image|max:2048',
        ]);

        $entry = InMemoriam::tenant()->findOrFail($id);

        $data = $request->only([
            'name',
            'graduation_year',
            'date_of_birth',
            'date_of_passing',
            'obituary',
            'tribute',
            'house',
            'class_arm'
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/in-memoriam'), $filename);
            $data['photo'] = 'uploads/in-memoriam/' . $filename;
        }

        $entry->update($data);

        return redirect()->route('admin.in-memoriam.index')
            ->with('success', __('Memorial entry updated successfully.'));
    }

    /**
     * Delete an entry.
     */
    public function destroy($id)
    {
        $entry = InMemoriam::tenant()->findOrFail($id);
        $entry->delete();

        return $this->success([], __('Memorial entry deleted.'));
    }
}
