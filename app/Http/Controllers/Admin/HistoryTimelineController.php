<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HistoryTimeline;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class HistoryTimelineController extends Controller
{
    use ResponseTrait;

    /**
     * Display the timeline management page.
     */
    public function index()
    {
        $data['title'] = __('Our History');
        $data['activeManageWebsiteSetting'] = 'active';
        $data['ourHistoryActiveClass'] = 'active-color-one';
        $data['timelines'] = HistoryTimeline::tenant()
            ->ordered()
            ->get();

        return view('admin.website_settings.our-history', $data);
    }

    /**
     * Store a new timeline entry.
     */
    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|string|max:100',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $maxOrder = HistoryTimeline::tenant()->max('sort_order') ?? 0;

        HistoryTimeline::create([
            'tenant_id' => getTenantId(),
            'year' => $request->year,
            'title' => $request->title,
            'description' => $request->description,
            'sort_order' => $maxOrder + 1,
        ]);

        return redirect()->route('admin.setting.website-settings.our-history')
            ->with('success', __('Timeline entry added successfully.'));
    }

    /**
     * Update an existing timeline entry.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'year' => 'required|string|max:100',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $entry = HistoryTimeline::tenant()->findOrFail($id);
        $entry->update($request->only(['year', 'title', 'description']));

        return redirect()->route('admin.setting.website-settings.our-history')
            ->with('success', __('Timeline entry updated successfully.'));
    }

    /**
     * Delete a timeline entry.
     */
    public function destroy($id)
    {
        $entry = HistoryTimeline::tenant()->findOrFail($id);
        $entry->delete();

        return $this->success([], __('Timeline entry deleted.'));
    }

    /**
     * Reorder timeline entries.
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:history_timelines,id',
        ]);

        foreach ($request->ids as $index => $id) {
            HistoryTimeline::tenant()->where('id', $id)->update(['sort_order' => $index + 1]);
        }

        return $this->success([], __('Timeline order updated.'));
    }
}
