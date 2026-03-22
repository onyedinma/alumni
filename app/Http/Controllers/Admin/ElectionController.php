<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Election;
use App\Models\ElectionPosition;
use App\Models\ElectionCandidate;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ElectionController extends Controller
{
    use ResponseTrait;

    /**
     * Display all elections
     */
    public function index(Request $request)
    {
        $data['title'] = __('Elections');
        $data['showElection'] = 'show';
        $data['activeElection'] = 'active';
        $data['elections'] = Election::tenant()
            ->with('creator')
            ->withCount('positions')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.elections.index', $data);
    }

    /**
     * Show create election form
     */
    public function create()
    {
        $data['title'] = __('Create Election');
        $data['showElection'] = 'show';
        $data['activeElection'] = 'active';
        return view('admin.elections.create', $data);
    }

    /**
     * Store new election
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $election = Election::create([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => 'draft',
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('admin.elections.positions', $election->slug)
            ->with('success', __('Election created successfully. Now add positions.'));
    }

    /**
     * Edit election
     */
    public function edit($slug)
    {
        $data['title'] = __('Edit Election');
        $data['showElection'] = 'show';
        $data['activeElection'] = 'active';
        $data['election'] = Election::tenant()->where('slug', $slug)->firstOrFail();
        return view('admin.elections.edit', $data);
    }

    /**
     * Update election
     */
    public function update(Request $request, $slug)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:draft,active,ended,published',
        ]);

        $election = Election::tenant()->where('slug', $slug)->firstOrFail();
        $election->update([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.elections.index')
            ->with('success', __('Election updated successfully.'));
    }

    /**
     * Delete election
     */
    public function delete($id)
    {
        $election = Election::tenant()->findOrFail($id);
        $election->delete();

        return redirect()->route('admin.elections.index')
            ->with('success', __('Election deleted successfully.'));
    }

    /**
     * Manage positions for an election
     */
    public function positions($slug)
    {
        $data['title'] = __('Manage Positions');
        $data['showElection'] = 'show';
        $data['activeElection'] = 'active';
        $data['election'] = Election::tenant()
            ->where('slug', $slug)
            ->with(['positions.allCandidates.user'])
            ->firstOrFail();

        return view('admin.elections.positions', $data);
    }

    /**
     * Add position to election
     */
    public function addPosition(Request $request, $slug)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $election = Election::tenant()->where('slug', $slug)->firstOrFail();

        $election->positions()->create([
            'title' => $request->title,
            'description' => $request->description,
            'order' => $election->positions()->count(),
        ]);

        return redirect()->back()->with('success', __('Position added successfully.'));
    }

    /**
     * Delete position
     */
    public function deletePosition($id)
    {
        $position = ElectionPosition::findOrFail($id);
        $position->delete();

        return redirect()->back()->with('success', __('Position deleted successfully.'));
    }

    /**
     * Manage candidates for an election
     */
    public function candidates($slug)
    {
        $data['title'] = __('Manage Candidates');
        $data['showElection'] = 'show';
        $data['activeElection'] = 'active';
        $data['election'] = Election::tenant()
            ->where('slug', $slug)
            ->with(['positions.allCandidates.user'])
            ->firstOrFail();
        $data['alumni'] = User::where('tenant_id', getTenantId())
            ->where('role', USER_ROLE_ALUMNI)
            ->where('status', STATUS_ACTIVE)
            ->get();

        return view('admin.elections.candidates', $data);
    }

    /**
     * Add candidate to position
     */
    public function addCandidate(Request $request, $slug)
    {
        $request->validate([
            'position_id' => 'required|exists:election_positions,id',
            'user_id' => 'required|exists:users,id',
            'manifesto' => 'nullable|string',
        ]);

        // Check if user is already a candidate for this position
        $exists = ElectionCandidate::where('position_id', $request->position_id)
            ->where('user_id', $request->user_id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', __('This user is already a candidate for this position.'));
        }

        ElectionCandidate::create([
            'position_id' => $request->position_id,
            'user_id' => $request->user_id,
            'manifesto' => $request->manifesto,
            'status' => 'approved',
        ]);

        return redirect()->back()->with('success', __('Candidate added successfully.'));
    }

    /**
     * Delete candidate
     */
    public function deleteCandidate($id)
    {
        $candidate = ElectionCandidate::findOrFail($id);
        $candidate->delete();

        return redirect()->back()->with('success', __('Candidate removed successfully.'));
    }

    /**
     * View election results
     */
    public function results($slug)
    {
        $data['title'] = __('Election Results');
        $data['showElection'] = 'show';
        $data['activeElection'] = 'active';
        $data['election'] = Election::tenant()
            ->where('slug', $slug)
            ->with([
                'positions.candidates' => function ($q) {
                    $q->withCount('votes')->orderByDesc('votes_count');
                },
                'positions.candidates.user'
            ])
            ->withCount('votes')
            ->firstOrFail();

        return view('admin.elections.results', $data);
    }

    /**
     * Publish election results
     */
    public function publish($slug)
    {
        $election = Election::tenant()->where('slug', $slug)->firstOrFail();
        $election->update(['status' => 'published']);

        return redirect()->back()->with('success', __('Results published successfully.'));
    }
}
