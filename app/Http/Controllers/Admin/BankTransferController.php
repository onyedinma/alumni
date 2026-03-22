<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankTransfer;
use App\Models\Payment;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BankTransferController extends Controller
{
    use ResponseTrait;

    /**
     * Display pending bank transfers.
     */
    public function index()
    {
        $data['title'] = __('Bank Transfer Approvals');
        $data['activeBankTransfer'] = 'active';
        $data['transfers'] = BankTransfer::tenant()
            ->with(['user', 'paymentable'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.bank-transfers.index', $data);
    }

    /**
     * Show transfer details.
     */
    public function show($id)
    {
        $data['title'] = __('Transfer Details');
        $data['activeBankTransfer'] = 'active';
        $data['transfer'] = BankTransfer::tenant()
            ->with(['user', 'paymentable', 'approver'])
            ->findOrFail($id);

        return view('admin.bank-transfers.show', $data);
    }

    /**
     * Approve a bank transfer.
     */
    public function approve(Request $request, $id)
    {
        $transfer = BankTransfer::tenant()->findOrFail($id);

        if (!$transfer->isPending()) {
            return $this->error([], __('This transfer has already been processed.'));
        }

        $transfer->update([
            'status' => 'approved',
            'admin_notes' => $request->admin_notes,
            'approved_by' => auth()->id(),
            'approved_at' => Carbon::now(),
        ]);

        // Create corresponding payment record if applicable
        if ($transfer->paymentable) {
            $this->createPaymentRecord($transfer);
        }

        return $this->success([], __('Bank transfer approved successfully.'));
    }

    /**
     * Reject a bank transfer.
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'admin_notes' => 'required|string|max:500',
        ]);

        $transfer = BankTransfer::tenant()->findOrFail($id);

        if (!$transfer->isPending()) {
            return $this->error([], __('This transfer has already been processed.'));
        }

        $transfer->update([
            'status' => 'rejected',
            'admin_notes' => $request->admin_notes,
            'approved_by' => auth()->id(),
            'approved_at' => Carbon::now(),
        ]);

        return $this->success([], __('Bank transfer rejected.'));
    }

    /**
     * Create a payment record after approval.
     */
    private function createPaymentRecord(BankTransfer $transfer)
    {
        Payment::create([
            'tenant_id' => $transfer->tenant_id,
            'user_id' => $transfer->user_id,
            'paymentable_type' => $transfer->paymentable_type,
            'paymentable_id' => $transfer->paymentable_id,
            'amount' => $transfer->amount,
            'payment_method' => 'bank_transfer',
            'status' => 'completed',
            'transaction_id' => $transfer->reference,
        ]);
    }
}
