<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Services\DashboardService;
use App\Models\Package;
use App\Models\Tenant;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserPackage;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    use ResponseTrait;

    public $dashboardService;

    public function __construct()
    {
        $this->dashboardService = new DashboardService();
    }

    public function index(Request $request)
    {
        $data['pageTitle'] = __('Dashboard');
        $data['activeDashboard'] = 'active';

        if(isAddonInstalled('ALUSAAS')) {
            $data['totalUser'] = User::where(['role' => USER_ROLE_ADMIN, 'status' => STATUS_ACTIVE])->count();
            $data['activePackage'] = Package::where(['status' => STATUS_ACTIVE])->count();
            $data['totalCurrentSubscription'] = UserPackage::where(['status' => STATUS_ACTIVE])->where('end_date', '>=', now())->count();
            $data['monthlyRevenue'] = Transaction::where('type', TRANSACTION_SUBSCRIPTION)->whereYear('payment_time', date('Y'))->whereMonth('payment_time', date('m'))->sum('amount');
            $data['monthlyOrderSummary'] = $this->dashboardService->getSuperAdminOrderSummary();
        } else {
            $firstTenant = Tenant::first()->id;
            if ($request->ajax()) {
                return $this->dashboardService->allTransactionList($firstTenant);
            }

            $data['totalAlumni'] = $this->dashboardService->totalAlumni($firstTenant);
            $data['currentMember'] = $this->dashboardService->currentMember($firstTenant);
            $data['totalUpcomingEvent'] = $this->dashboardService->totalUpcomingEvent($firstTenant);
            $data['memberThisMonth'] = $this->dashboardService->memberThisMonth($firstTenant);
            $data['transactionThisMonth'] = $this->dashboardService->transactionThisMonth($firstTenant);
            $data['chart'] = $this->dashboardService->dashboardDailyMembershipPaymentChart($firstTenant);
            $d = array();
            $preDateCount = 15;
            for ($i = 0; $i <= $preDateCount; $i++) {
                $dateval = date("M d", strtotime('-' . $i . ' days'));
                $d[] = $dateval;
                if (in_array($dateval, $data['chart']['days'])) {
                    $chartPrice[] = $data['chart']['price'][$dateval];
                } else {
                    $chartPrice[] = 0;
                }
            }
            $data['chartPrice'] = json_encode(array_reverse($chartPrice));
            $data['dayList'] = json_encode(array_reverse($d));
            $topEventTickets = $this->dashboardService->dashboardTopEventTicketChart($firstTenant);
            $data['totalTickets'] = json_encode($topEventTickets['totalTicket']);
            $data['eventNames'] = json_encode($topEventTickets['eventName']);
        }

        return view('super_admin.dashboard', $data);
    }

}
