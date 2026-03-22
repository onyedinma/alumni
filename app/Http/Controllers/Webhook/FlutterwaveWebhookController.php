<?php

namespace App\Http\Controllers\Webhook;

use App\Http\Controllers\Controller;
use App\Http\Services\Payment\FlutterwaveService;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FlutterwaveWebhookController extends Controller
{
    /**
     * Handle Flutterwave webhook events
     * 
     * Configure this URL in Flutterwave Dashboard:
     * https://your-domain.com/webhook/flutterwave
     */
    public function handle(Request $request)
    {
        // Get the signature from header
        $signature = $request->header('verif-hash');

        // Verify webhook signature
        if (!$signature || !FlutterwaveService::verifyWebhookSignature('', $signature)) {
            Log::warning('Flutterwave webhook: Invalid signature');
            return response()->json(['error' => 'Invalid signature'], 401);
        }

        $event = $request->all();

        Log::info('Flutterwave webhook received', [
            'event' => $event['event'] ?? 'unknown',
            'tx_ref' => $event['data']['tx_ref'] ?? 'N/A',
        ]);

        // Handle successful charge
        if (($event['event'] ?? '') === 'charge.completed') {
            return $this->handleChargeCompleted($event['data'] ?? []);
        }

        return response()->json(['message' => 'Event received']);
    }

    /**
     * Handle completed charge (payment)
     */
    protected function handleChargeCompleted(array $data)
    {
        $txRef = $data['tx_ref'] ?? null;
        $status = $data['status'] ?? '';

        if (!$txRef) {
            return response()->json(['error' => 'No transaction reference'], 400);
        }

        // Only process successful payments
        if ($status !== 'successful') {
            Log::info('Flutterwave webhook: Non-successful status', ['status' => $status]);
            return response()->json(['message' => 'Status noted']);
        }

        // Find payment by reference
        $payment = Payment::where('paymentId', $txRef)
            ->orWhere('tnxId', $txRef)
            ->first();

        if ($payment && $payment->payment_status !== 'success') {
            $payment->update([
                'payment_status' => 'success',
                'gateway_callback_details' => json_encode($data),
            ]);

            Transaction::where('payment_id', $payment->id)->update([
                'payment_status' => 'success',
            ]);

            Log::info('Flutterwave webhook: Payment marked successful', [
                'payment_id' => $payment->id,
                'tx_ref' => $txRef,
            ]);
        }

        return response()->json(['message' => 'Charge completed processed']);
    }
}
