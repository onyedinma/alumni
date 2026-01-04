<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Donation;
use App\Models\DonationCampaign;
use App\Models\Gateway;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DonationController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $data['title'] = __('Make a Donation');
        $data['campaigns'] = DonationCampaign::tenant()->active()->orderBy('is_featured', 'desc')->orderBy('created_at', 'desc')->get();
        $data['gateways'] = Gateway::where('status', ACTIVE)->where('tenant_id', getTenantId())->get();
        $data['banks'] = Bank::where('status', ACTIVE)->where('tenant_id', getTenantId())->get();
        return view('frontend.donation_modern', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'donor_name' => 'required|string|max:255',
            'donor_email' => 'required|email|max:255',
            'amount' => 'required|numeric|min:100',
            'campaign_id' => 'nullable|exists:donation_campaigns,id',
        ]);

        // Create pending donation record
        $donation = Donation::create([
            'tenant_id' => getTenantId(),
            'campaign_id' => $request->campaign_id,
            'user_id' => auth()->check() ? auth()->id() : null,
            'donor_name' => $request->donor_name,
            'donor_email' => $request->donor_email,
            'donor_phone' => $request->donor_phone,
            'amount' => $request->amount,
            'message' => $request->message,
            'status' => 0, // pending
        ]);

        // Store donation ID in session for checkout
        session(['pending_donation_id' => $donation->id]);

        // Redirect to checkout
        return redirect()->route('donation.checkout');
    }

    public function checkout()
    {
        $donationId = session('pending_donation_id');

        if (!$donationId) {
            return redirect()->route('donation.index')->with('error', __('Please fill in your donation details first'));
        }

        $donation = Donation::find($donationId);

        if (!$donation) {
            return redirect()->route('donation.index')->with('error', __('Donation not found'));
        }

        $data['title'] = __('Complete Donation');
        $data['donation'] = $donation;
        $data['product_name'] = __('Donation to FGC Ohafia 2007 Alumni');
        $data['price'] = $donation->amount;
        $data['type'] = 'donation';
        $data['id'] = $donation->id;
        $data['gateways'] = Gateway::where('status', ACTIVE)->where('tenant_id', getTenantId())->get();
        $data['banks'] = Bank::where('status', ACTIVE)->where('tenant_id', getTenantId())->get();

        return view('frontend.donation-checkout-modern', $data);
    }

    public function success()
    {
        // Clear session data
        session()->forget('pending_donation_id');

        $data['title'] = __('Donation Successful');
        return view('frontend.donation-success', $data);
    }
}
