<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Http\Services\DashboardService;
use App\Http\Services\HardwareService;
use App\Http\Services\NewsService;
use App\Http\Services\NotificationService;
use App\Models\Bank;
use App\Models\Category;
use App\Models\FavouriteCoinPairs;
use App\Models\FileManager;
use App\Models\SearchResult;
use App\Models\SearchResultItem;
use App\Models\User;
use App\Models\UserWallet;
use App\Services\SubscriptionService;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    use ResponseTrait;
    public $tradeService;
    public $newsService;
    public $hardwareService;
    public $walletService;
    public $dashboardService;

    public function __construct()
    {
        $this->newsService = new NewsService;
        $this->dashboardService = new DashboardService;
    }

    public function index(Request $request)
    {
        $data['activeDashboard'] = 'active';
        $data['pageTitle'] = __('Dashboard');
        $data['upcomingEvents'] = $this->dashboardService->getUpcomingEvent()->getData()->data;
        $data['latestJobs'] = $this->dashboardService->getLatestJobs()->getData()->data;
        $data['latestNews'] = $this->dashboardService->getLatestNews()->getData()->data;
        $data['latestNotice'] = $this->dashboardService->getLatestNotice()->getData()->data;
        $data['user'] = auth()->user();

        return view('alumni.home', $data);
    }
    public function tester()
    {
        // $customData = ['customField1'=> "With Best Regards",
        // 'customField2'=> "fgco07alumni Authority"];
        // $userData = auth()->user();

        // genericEmailNotify('',$userData,$customData,'custom-email');


        // $user_id = auth()->id();
        // $title = "Job Post-101";
        // $details = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book";
        // $link = "http://localhost:8000/job-post/details/Job-Post-101";

        // setCommonNotification( $title, $details,$link,$user_id);

        // $user_id = auth()->id();
        // $title = "Job Post-105";
        // $details = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book";
        // $link = "http://localhost:8000/job-post/details/Job-Post-105";

        // setCommonNotification( $title, $details,$link,$user_id);

        // $user_id = 2;
        // $title = "Job Post-101";
        // $details = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book";
        // $link = "http://localhost:8000/job-post/details/Job-Post-101";

        // setCommonNotification( $title, $details,$link,$user_id);

        // $user_id = 2;
        // $title = "Job Post-105";
        // $details = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book";
        // $link = "http://localhost:8000/job-post/details/Job-Post-105";

        // setCommonNotification( $title, $details,$link,$user_id);

        //send notification end
    }
}
