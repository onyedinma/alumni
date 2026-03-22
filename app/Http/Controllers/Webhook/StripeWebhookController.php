<?php

namespace App\Http\Controllers\Webhook;

use App\Http\Controllers\Controller;
use App\Http\Services\Payment\StripeService;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StripeWebhookController extends Controller
{
    /**
     * Handle Stripe webhook events
     * 
     * Configure this URL in Stripe Dashboard:
     * https://your-domain.com/webhook/stripe
     */
    public function handle(Request $request)
    {
        $payload = $request->getContent();
        $signature = $request->header('Stripe-Signature');
        $endpointSecret = env('STRIPE_WEBHOOK_SECRET', '');

        // Verify webhook signature if secret is configured
        if ($endpointSecret && !StripeService::verifyWebhookSignature($payload, $signature, $endpointSecret)) {
            Log::warning('Stripe webhook: Invalid signature');
            return response()->json(['error' => 'Invalid signature'], 401);
        }

        $event = $request->all();

        Log::info('Stripe webhook received', [
            'type' => $event['type'] ?? 'unknown',
        ]);

        // Handle different event types
        switch ($event['type'] ?? '') {
            case 'payment_intent.succeeded':
                return $this->handlePaymentSucceeded($event['data']['object'] ?? []);

            case 'payment_intent.payment_failed':
                return $this->handlePaymentFailed($event['data']['object'] ?? []);

            case 'checkout.session.completed':
                return $this->handleCheckoutCompleted($event['data']['object'] ?? []);

            default:
                return response()->json(['message' => 'Event received']);
        }
    }

    /**
     * Handle successful payment
     */
    protected function handlePaymentSucceeded(array $data)
    {
        $paymentIntentId = $data['id'] ?? null;

        if (!$paymentIntentId) {
            return response()->json(['error' => 'No payment intent ID'], 400);
        }

        $payment = Payment::where('paymentId', $paymentIntentId)
            ->orWhere('tnxId', $paymentIntentId)
            ->first();

        if ($payment && $payment->payment_status !== 'success') {
            $payment->update([
                'payment_status' => 'success',
                'gateway_callback_details' => json_encode($data),
            ]);

            Transaction::where('payment_id', $payment->id)->update([
                'payment_status' => 'success',
            ]);

            Log::info('Stripe webhook: Payment marked successful', [
                'payment_id' => $payment->id,
                'payment_intent' => $paymentIntentId,
            ]);
        }

        return response()->json(['message' => 'Payment succeeded processed']);
    }

    /**
     * Handle failed payment
     */
    protected function handlePaymentFailed(array $data)
    {
        $paymentIntentId = $data['id'] ?? null;

        if (!$paymentIntentId) {
            return response()->json(['error' => 'No payment intent ID'], 400);
        }

        $payment = Payment::where('paymentId', $paymentIntentId)
            ->orWhere('tnxId', $paymentIntentId)
            ->first();

        if ($payment && $payment->payment_status !== 'success') {
            $payment->update([
                'payment_status' => 'failed',
                'gateway_callback_details' => json_encode($data),
            ]);

            Log::warning('Stripe webhook: Payment failed', [
                'payment_id' => $payment->id,
                'payment_intent' => $paymentIntentId,
                'error' => $data['last_payment_error']['message'] ?? 'Unknown error',
            ]);
        }

        return response()->json(['message' => 'Payment failed processed']);
    }

    /**
     * Handle checkout session completed
     */
    protected function handleCheckoutCompleted(array $data)
    {
        Log::info('Stripe webhook: Checkout completed', [
            'session_id' => $data['id'] ?? 'N/A',
            'payment_intent' => $data['payment_intent'] ?? 'N/A',
        ]);

        return response()->json(['message' => 'Checkout completed processed']);
    }
}
