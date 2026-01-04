<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\DonationCampaign;
use App\Models\FileManager;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DonationCampaignController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $data['title'] = __('Donation Campaigns');
        $data['activeDonationCampaign'] = 'active';
        $data['campaigns'] = DonationCampaign::tenant()->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.donation-campaigns.index', $data);
    }

    public function create()
    {
        $data['title'] = __('Create Campaign');
        $data['activeDonationCampaign'] = 'active';
        return view('admin.donation-campaigns.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'goal_amount' => 'nullable|numeric|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'beneficiary_name' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $campaign = new DonationCampaign();
        $campaign->title = $request->title;
        $campaign->description = $request->description;
        $campaign->goal_amount = $request->goal_amount;
        $campaign->start_date = $request->start_date;
        $campaign->end_date = $request->end_date;
        $campaign->beneficiary_name = $request->beneficiary_name;
        $campaign->status = $request->status ?? STATUS_ACTIVE;
        $campaign->is_featured = $request->is_featured ? true : false;

        if ($request->hasFile('image')) {
            $fileManager = new FileManager();
            $uploaded = $fileManager->upload('donation-campaigns', $request->image);
            $campaign->image_id = $uploaded->id;
        }

        $campaign->save();

        return redirect()->route('admin.donation-campaigns.index')
            ->with('success', __('Campaign created successfully'));
    }

    public function edit($id)
    {
        $data['title'] = __('Edit Campaign');
        $data['activeDonationCampaign'] = 'active';
        $data['campaign'] = DonationCampaign::tenant()->findOrFail($id);
        return view('admin.donation-campaigns.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'goal_amount' => 'nullable|numeric|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'beneficiary_name' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $campaign = DonationCampaign::tenant()->findOrFail($id);
        $campaign->title = $request->title;
        $campaign->description = $request->description;
        $campaign->goal_amount = $request->goal_amount;
        $campaign->start_date = $request->start_date;
        $campaign->end_date = $request->end_date;
        $campaign->beneficiary_name = $request->beneficiary_name;
        $campaign->status = $request->status ?? STATUS_ACTIVE;
        $campaign->is_featured = $request->is_featured ? true : false;

        if ($request->hasFile('image')) {
            $fileManager = new FileManager();
            $uploaded = $fileManager->upload('donation-campaigns', $request->image);
            $campaign->image_id = $uploaded->id;
        }

        $campaign->save();

        return redirect()->route('admin.donation-campaigns.index')
            ->with('success', __('Campaign updated successfully'));
    }

    public function destroy($id)
    {
        $campaign = DonationCampaign::tenant()->findOrFail($id);
        $campaign->delete();

        return redirect()->route('admin.donation-campaigns.index')
            ->with('success', __('Campaign deleted successfully'));
    }

    public function toggleStatus($id)
    {
        $campaign = DonationCampaign::tenant()->findOrFail($id);
        $campaign->status = $campaign->status == STATUS_ACTIVE ? STATUS_DISABLE : STATUS_ACTIVE;
        $campaign->save();

        return response()->json([
            'success' => true,
            'message' => __('Status updated successfully'),
            'status' => $campaign->status
        ]);
    }

    public function donations($id)
    {
        $data['title'] = __('Campaign Donations');
        $data['activeDonationCampaign'] = 'active';
        $data['campaign'] = DonationCampaign::tenant()->findOrFail($id);
        $data['donations'] = Donation::where('campaign_id', $id)->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.donation-campaigns.donations', $data);
    }
}
