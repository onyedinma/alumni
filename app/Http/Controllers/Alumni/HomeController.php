<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Http\Services\DashboardService;
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
    public $dashboardService;

    public function __construct()
    {
        $this->dashboardService = new DashboardService();
    }

    public function index(Request $request)
    {
        $data['pageTitle'] = __('Timeline');
        $data['activeHome'] = 'active';
        $data['upcomingEvents'] = $this->dashboardService->getUpcomingEvent()->getData()->data;
        $data['latestJobs'] = $this->dashboardService->getLatestJobs()->getData()->data;
        $data['latestNews'] = $this->dashboardService->getLatestNews()->getData()->data;
        $data['latestNotice'] = $this->dashboardService->getLatestNotice()->getData()->data;
        $data['user'] = auth()->user();
        return view('alumni.home', $data);
    }

    public function loadMorePost(Request $request)
    {
        return $this->dashboardService->getMorePost($request);
    }
}
