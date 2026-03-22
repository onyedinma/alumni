<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HallOfFame;
use App\Models\HallOfFameNomination;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class HallOfFameController extends Controller
{
    use ResponseTrait;

    /**
     * Display all Hall of Fame entries.
     */
    public function index()
    {
        $data['title'] = __('Hall of Fame');
        $data['activeHallOfFame'] = 'active';
        $data['entries'] = HallOfFame::tenant()
            ->with(['creator'])
            ->orderByDesc('year_inducted')
            ->paginate(20);
        $data['categories'] = HallOfFame::categories();

        return view('admin.hall-of-fame.index', $data);
    }

    /**
     * Show form for creating new entry.
     */
    public function create()
    {
        $data['title'] = __('Add Hall of Fame Entry');
        $data['activeHallOfFame'] = 'active';
        $data['categories'] = HallOfFame::categories();
        return view('admin.hall-of-fame.create', $data);
    }

    /**
     * Store a new entry.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'achievement_title' => 'required|string|max:255',
            'year_inducted' => 'required|integer|min:1900|max:' . date('Y'),
            'photo' => 'nullable|image|max:2048',
            'graduation_year' => 'nullable|integer|min:1900|max:' . date('Y'),
        ]);

        $data = $request->only([
            'name',
            'graduation_year',
            'category',
            'achievement_title',
            'achievement_description',
            'year_inducted',
        ]);
        $data['tenant_id'] = getTenantId();
        $data['created_by'] = auth()->id();
        $data['is_featured'] = $request->has('is_featured');
        $data['status'] = $request->input('status', 'active');

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/hall-of-fame'), $filename);
            $data['photo'] = 'uploads/hall-of-fame/' . $filename;
        }

        HallOfFame::create($data);

        return redirect()->route('admin.hall-of-fame.index')
            ->with('success', __('Hall of Fame entry added successfully.'));
    }

    /**
     * Show form for editing entry.
     */
    public function edit($id)
    {
        $data['title'] = __('Edit Hall of Fame Entry');
        $data['activeHallOfFame'] = 'active';
        $data['entry'] = HallOfFame::tenant()->findOrFail($id);
        $data['categories'] = HallOfFame::categories();
        return view('admin.hall-of-fame.edit', $data);
    }

    /**
     * Update an entry.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'achievement_title' => 'required|string|max:255',
            'year_inducted' => 'required|integer|min:1900|max:' . date('Y'),
            'photo' => 'nullable|image|max:2048',
        ]);

        $entry = HallOfFame::tenant()->findOrFail($id);

        $data = $request->only([
            'name',
            'graduation_year',
            'category',
            'achievement_title',
            'achievement_description',
            'year_inducted',
        ]);
        $data['is_featured'] = $request->has('is_featured');
        $data['status'] = $request->input('status', 'active');

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/hall-of-fame'), $filename);
            $data['photo'] = 'uploads/hall-of-fame/' . $filename;
        }

        $entry->update($data);

        return redirect()->route('admin.hall-of-fame.index')
            ->with('success', __('Hall of Fame entry updated successfully.'));
    }

    /**
     * Delete an entry.
     */
    public function destroy($id)
    {
        $entry = HallOfFame::tenant()->findOrFail($id);
        $entry->delete();

        return $this->success([], __('Hall of Fame entry deleted.'));
    }

    /**
     * Display pending nominations.
     */
    public function nominations()
    {
        $data['title'] = __('Hall of Fame Nominations');
        $data['activeHallOfFame'] = 'active';
        $data['nominations'] = HallOfFameNomination::tenant()
            ->with(['nominator'])
            ->orderByDesc('created_at')
            ->paginate(20);
        $data['categories'] = HallOfFame::categories();

        return view('admin.hall-of-fame.nominations', $data);
    }

    /**
     * Approve a nomination.
     */
    public function approveNomination(Request $request, $id)
    {
        $nomination = HallOfFameNomination::tenant()->findOrFail($id);

        // Create Hall of Fame entry from nomination
        $hallOfFame = HallOfFame::create([
            'tenant_id' => getTenantId(),
            'name' => $nomination->nominee_name,
            'graduation_year' => $nomination->nominee_graduation_year,
            'category' => $nomination->category,
            'achievement_title' => $request->input('achievement_title', $nomination->category . ' Achievement'),
            'achievement_description' => $nomination->nomination_reason,
            'year_inducted' => date('Y'),
            'status' => 'active',
            'created_by' => auth()->id(),
        ]);

        // Update nomination status
        $nomination->update([
            'status' => 'approved',
            'hall_of_fame_id' => $hallOfFame->id,
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        return redirect()->route('admin.hall-of-fame.nominations')
            ->with('success', __('Nomination approved and added to Hall of Fame.'));
    }

    /**
     * Reject a nomination.
     */
    public function rejectNomination($id)
    {
        $nomination = HallOfFameNomination::tenant()->findOrFail($id);

        $nomination->update([
            'status' => 'rejected',
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        return redirect()->route('admin.hall-of-fame.nominations')
            ->with('success', __('Nomination rejected.'));
    }
}
