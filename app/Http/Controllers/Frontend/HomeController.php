<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Services\DashboardService;
use App\Http\Services\Frontend\HomeService;
use App\Models\Batch;
use App\Models\Department;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use ResponseTrait;
    public $homeService;

    public function __construct()
    {
        $this->homeService = new HomeService();
    }

    public function index(Request $request)
    {
        $data['upcomingEvents'] = $this->homeService->getUpcomingEvent();
        $data['stories'] = $this->homeService->getStories(3);
        $data['photoGalleries'] = $this->homeService->getPhotoGalleries();
        $data['news'] = $this->homeService->getNews(3);
        $data['alumnus'] = $this->homeService->getAlumni(8);
        $data['totalAlumni'] = User::where('users.tenant_id', getTenantId())->where('role', USER_ROLE_ALUMNI)->where('status', STATUS_ACTIVE)->count();
        $data['totalDepartments'] = Department::where('tenant_id', getTenantId())->count();
        $data['totalSessions'] = Batch::where('tenant_id', getTenantId())->count();

        // Current Excos
        $currentTenor = \App\Models\ExcoTenor::tenant()->where('is_current', true)->first() ?? \App\Models\ExcoTenor::tenant()->latest('start_date')->first();
        if ($currentTenor) {
            $data['excos'] = \App\Models\Exco::tenant()
                ->where('exco_tenor_id', $currentTenor->id)
                ->where('status', 1)
                ->orderBy('order', 'asc')
                ->get();
            $data['currentTenorName'] = $currentTenor->title;
        } else {
            $data['excos'] = collect();
            $data['currentTenorName'] = '';
        }

        // Mini Poll
        $data['activePoll'] = \App\Models\MiniPoll::where('status', 1)
            ->where(function ($query) {
                $query->whereNull('start_date')->orWhere('start_date', '<=', now());
            })
            ->where(function ($query) {
                $query->whereNull('end_date')->orWhere('end_date', '>=', now());
            })
            ->with([
                'options' => function ($q) {
                    $q->orderBy('id');
                }
            ])
            ->latest()
            ->first();

        // Check if user voted
        if ($data['activePoll']) {
            $ip = $request->ip();
            $userId = auth()->id();

            $hasVoted = \App\Models\MiniPollVote::where('mini_poll_id', $data['activePoll']->id)
                ->where(function ($q) use ($ip, $userId) {
                    $q->where('ip_address', $ip);
                    if ($userId) {
                        $q->orWhere('user_id', $userId);
                    }
                })
                ->exists();

            $data['hasVoted'] = $hasVoted;
        }

        return view('frontend.index_modern', $data);
    }


    public function page($slug)
    {
        // Normalize slug: URL uses hyphens (about-us) but DB options use underscores (about_us_title)
        $optionKey = str_replace('-', '_', $slug);
        $data['pageTitle'] = __(getOption($optionKey . '_title'));
        $data['description'] = getOption($optionKey . '_description');
        return view('frontend.page_modern', $data);
    }

    public function aboutUs()
    {
        $data['title'] = __('Our History');
        $data['timelines'] = \App\Models\HistoryTimeline::tenant()
            ->active()
            ->ordered()
            ->get();
        return view('frontend.history_modern', $data);
    }

    public function schoolIdentity()
    {
        $data['title'] = __('School Identity');
        return view('frontend.school_identity', $data);
    }

    public function gallery(Request $request)
    {
        $data['title'] = __('Photo Gallery');
        $decade = $request->get('decade');
        $data['photoGalleries'] = $this->homeService->getPhotoGalleriesWithFilter($decade);
        $data['decades'] = $this->homeService->getGalleryDecades();
        $data['currentDecade'] = $decade;
        return view('frontend.gallery', $data);
    }

    public function voteMiniPoll(Request $request)
    {
        $request->validate([
            'poll_id' => 'required|exists:mini_polls,id',
            'option_id' => 'required|exists:mini_poll_options,id',
        ]);

        $poll = \App\Models\MiniPoll::findOrFail($request->poll_id);
        $ip = $request->ip();
        $userId = auth()->id();

        // Double check vote
        $hasVoted = \App\Models\MiniPollVote::where('mini_poll_id', $poll->id)
            ->where(function ($q) use ($ip, $userId) {
                $q->where('ip_address', $ip);
                if ($userId) {
                    $q->orWhere('user_id', $userId);
                }
            })
            ->exists();

        if ($hasVoted) {
            return $this->error([], __('You have already voted!'));
        }

        // Record vote
        \App\Models\MiniPollVote::create([
            'mini_poll_id' => $poll->id,
            'user_id' => $userId,
            'ip_address' => $ip,
        ]);

        // Increment count
        $option = \App\Models\MiniPollOption::findOrFail($request->option_id);
        $option->increment('vote_count');

        return $this->success(['results' => $this->getPollResults($poll)], __('Vote recorded!'));
    }

    private function getPollResults($poll)
    {
        $totalVotes = $poll->votes()->count();
        $options = $poll->options->map(function ($opt) use ($totalVotes) {
            $percent = $totalVotes > 0 ? round(($opt->vote_count / $totalVotes) * 100) : 0;
            return [
                'id' => $opt->id,
                'text' => $opt->option_text,
                'percent' => $percent,
                'count' => $opt->vote_count
            ];
        });

        return [
            'total' => $totalVotes,
            'options' => $options
        ];
    }

}
