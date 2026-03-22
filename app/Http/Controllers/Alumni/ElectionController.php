<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\Election;
use App\Models\ElectionVote;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class ElectionController extends Controller
{
    use ResponseTrait;

    /**
     * Display active elections
     */
    public function index()
    {
        $data['title'] = __('Elections');
        $data['activeElection'] = 'active';
        $data['elections'] = Election::tenant()
            ->whereIn('status', ['active', 'published'])
            ->orderByDesc('created_at')
            ->get();

        return view('alumni.election.index', $data);
    }

    /**
     * Show voting interface for an election
     */
    public function vote($slug)
    {
        $election = Election::tenant()
            ->where('slug', $slug)
            ->where('status', 'active')
            ->with(['positions.candidates.user'])
            ->firstOrFail();

        // Check if election is still open
        if (!$election->is_active) {
            return redirect()->route('election.index')
                ->with('error', __('This election is no longer active.'));
        }

        // Get user's existing votes for this election
        $existingVotes = ElectionVote::where('election_id', $election->id)
            ->where('voter_id', auth()->id())
            ->pluck('candidate_id', 'position_id')
            ->toArray();

        $data['title'] = __('Vote - ') . $election->title;
        $data['activeElection'] = 'active';
        $data['election'] = $election;
        $data['existingVotes'] = $existingVotes;

        return view('alumni.election.vote', $data);
    }

    /**
     * Cast a vote
     */
    public function castVote(Request $request, $slug)
    {
        $request->validate([
            'position_id' => 'required|exists:election_positions,id',
            'candidate_id' => 'required|exists:election_candidates,id',
        ]);

        $election = Election::tenant()
            ->where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        if (!$election->is_active) {
            return $this->error([], __('Election is no longer active.'));
        }

        // Check if user already voted for this position
        $existingVote = ElectionVote::where('election_id', $election->id)
            ->where('position_id', $request->position_id)
            ->where('voter_id', auth()->id())
            ->first();

        if ($existingVote) {
            return $this->error([], __('You have already voted for this position.'));
        }

        // Cast the vote
        ElectionVote::create([
            'election_id' => $election->id,
            'position_id' => $request->position_id,
            'candidate_id' => $request->candidate_id,
            'voter_id' => auth()->id(),
        ]);

        return $this->success([], __('Vote cast successfully!'));
    }

    /**
     * Submit all votes and finish voting
     */
    public function submitVotes(Request $request, $slug)
    {
        $election = Election::tenant()
            ->where('slug', $slug)
            ->firstOrFail();

        return redirect()->route('election.results', $election->slug)
            ->with('success', __('Thank you for voting!'));
    }

    /**
     * View election results (only if published)
     */
    public function results($slug)
    {
        $election = Election::tenant()
            ->where('slug', $slug)
            ->where('status', 'published')
            ->with([
                'positions.candidates' => function ($q) {
                    $q->withCount('votes')->orderByDesc('votes_count');
                },
                'positions.candidates.user'
            ])
            ->firstOrFail();

        $data['title'] = __('Results - ') . $election->title;
        $data['activeElection'] = 'active';
        $data['election'] = $election;

        return view('alumni.election.results', $data);
    }
}
