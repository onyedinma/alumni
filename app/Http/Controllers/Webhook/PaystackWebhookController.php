<?php

namespace App\Http\Controllers\Webhook;

use App\Http\Controllers\Controller;
use App\Http\Services\Payment\PaystackService;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaystackWebhookController extends Controller
{
    /**
     * Handle Paystack webhook events
     * 
     * Configure this URL in Paystack Dashboard:
     * https://your-domain.com/webhook/paystack
     */
    public function handle(Request $request)
    {
        // Get the raw payload and signature
        $payload = $request->getContent();
        $signature = $request->header('x-paystack-signature');

        // Verify webhook signature
        if (!$signature || !PaystackService::verifyWebhookSignature($payload, $signature)) {
            Log::warning('Paystack webhook: Invalid signature');
            return response()->json(['error' => 'Invalid signature'], 401);
        }

        $event = $request->all();

        Log::info('Paystack webhook received', [
            'event' => $event['event'] ?? 'unknown',
            'reference' => $event['data']['reference'] ?? 'N/A',
        ]);

        // Handle different event types
        switch ($event['event'] ?? '') {
            case 'charge.success':
                return $this->handleChargeSuccess($event['data']);

            case 'charge.failed':
                return $this->handleChargeFailed($event['data']);

            case 'transfer.success':
                return $this->handleTransferSuccess($event['data']);

            case 'transfer.failed':
                return $this->handleTransferFailed($event['data']);

            default:
                Log::info('Paystack webhook: Unhandled event type', ['event' => $event['event'] ?? 'unknown']);
                return response()->json(['message' => 'Event received']);
        }
    }

    /**
     * Handle successful charge (payment)
     */
    protected function handleChargeSuccess(array $data)
    {
        $reference = $data['reference'] ?? null;

        if (!$reference) {
            return response()->json(['error' => 'No reference'], 400);
        }

        // Find payment by reference
        $payment = Payment::where('paymentId', $reference)
            ->orWhere('tnxId', $reference)
            ->first();

        if ($payment) {
            // Update payment status if not already successful
            if ($payment->payment_status !== 'success') {
                $payment->update([
                    'payment_status' => 'success',
                    'gateway_callback_details' => json_encode($data),
                ]);

                // Update related transaction
                Transaction::where('payment_id', $payment->id)->update([
                    'payment_status' => 'success',
                ]);

                Log::info('Paystack webhook: Payment marked successful', [
                    'payment_id' => $payment->id,
                    'reference' => $reference,
                ]);
            }
        }

        return response()->json(['message' => 'Charge success processed']);
    }

    /**
     * Handle failed charge
     */
    protected function handleChargeFailed(array $data)
    {
        $reference = $data['reference'] ?? null;

        if (!$reference) {
            return response()->json(['error' => 'No reference'], 400);
        }

        $payment = Payment::where('paymentId', $reference)
            ->orWhere('tnxId', $reference)
            ->first();

        if ($payment && $payment->payment_status !== 'success') {
            $payment->update([
                'payment_status' => 'failed',
                'gateway_callback_details' => json_encode($data),
            ]);

            Log::warning('Paystack webhook: Payment failed', [
                'payment_id' => $payment->id,
                'reference' => $reference,
                'reason' => $data['gateway_response'] ?? 'Unknown',
            ]);
        }

        return response()->json(['message' => 'Charge failed processed']);
    }

    /**
     * Handle successful transfer
     */
    protected function handleTransferSuccess(array $data)
    {
        Log::info('Paystack webhook: Transfer success', $data);
        return response()->json(['message' => 'Transfer success processed']);
    }

    /**
     * Handle failed transfer
     */
    protected function handleTransferFailed(array $data)
    {
        Log::warning('Paystack webhook: Transfer failed', $data);
        return response()->json(['message' => 'Transfer failed processed']);
    }
}
