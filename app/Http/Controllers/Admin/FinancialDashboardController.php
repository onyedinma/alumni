<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\DonationCampaign;
use App\Models\Payment;
use App\Models\BankTransfer;
use App\Models\UserMembershipPlan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FinancialDashboardController extends Controller
{
    /**
     * Display financial transparency dashboard.
     */
    public function index()
    {
        $data['title'] = __('Financial Dashboard');
        $data['activeFinancialDashboard'] = 'active';

        // Overall Stats
        $data['totalDonations'] = Donation::sum('amount');
        $data['totalMemberships'] = Payment::where('paymentable_type', 'App\Models\Package')->sum('grand_total');
        $data['pendingBankTransfers'] = BankTransfer::tenant()->where('status', 'pending')->count();
        $data['approvedTransfersAmount'] = BankTransfer::tenant()->where('status', 'approved')->sum('amount');

        // Monthly Trends (last 6 months)
        $data['monthlyTrends'] = $this->getMonthlyTrends();

        // Donation Campaigns Progress
        $data['campaigns'] = DonationCampaign::withSum('donations', 'amount')
            ->where('status', 1)
            ->orderByDesc('donations_sum_amount')
            ->take(5)
            ->get();

        // Recent Transactions
        $data['recentPayments'] = Payment::with(['user', 'paymentable'])
            ->orderByDesc('created_at')
            ->take(10)
            ->get();

        // Top Contributors
        $data['topContributors'] = Donation::select('user_id')
            ->selectRaw('SUM(amount) as total_amount')
            ->with('user')
            ->groupBy('user_id')
            ->orderByDesc('total_amount')
            ->take(5)
            ->get();

        // Membership Stats
        $data['activeMemberships'] = UserMembershipPlan::where('status', 1)
            ->where('expired_date', '>', now())
            ->count();

        $data['expiringMemberships'] = UserMembershipPlan::where('status', 1)
            ->whereBetween('expired_date', [now(), now()->addDays(30)])
            ->count();

        return view('admin.financial-dashboard.index', $data);
    }

    /**
     * Get monthly donation/payment trends.
     */
    private function getMonthlyTrends()
    {
        $trends = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $trends[] = [
                'month' => $month->format('M Y'),
                'donations' => Donation::whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->sum('amount'),
                'memberships' => Payment::where('paymentable_type', 'App\Models\Package')
                    ->whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->sum('grand_total'),
            ];
        }
        return $trends;
    }

    /**
     * Export financial report as PDF.
     */
    public function exportPdf(Request $request)
    {
        // TODO: Implement PDF export
        return back()->with('info', 'PDF export coming soon');
    }
}
