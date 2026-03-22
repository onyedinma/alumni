<?php

namespace App\Http\Services\Payment;

use Illuminate\Support\Facades\Log;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

class StripeService extends BasePaymentService
{
    private StripeClient $stripeClient;

    public function __construct($method, $object)
    {
        parent::__construct($method, $object);
        $this->stripeClient = new StripeClient($this->gateway->secret); // Secret key for API calls
    }

    /**
     * Initialize a payment checkout session
     */
    public function makePayment($amount)
    {
        $this->setAmount($amount);

        try {
            $session = $this->stripeClient->checkout->sessions->create([
                'success_url' => $this->callbackUrl,
                'cancel_url' => $this->callbackUrl . '&cancelled=true',
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => strtolower($this->currency),
                            'product_data' => [
                                'name' => config('app.name', 'Alumni Platform') . ' Payment',
                                'description' => 'Payment for services',
                            ],
                            'unit_amount' => (int) ($this->amount * 100), // Stripe expects cents
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'customer_email' => auth()->user()->email ?? null,
                'metadata' => [
                    'order_id' => request()->get('id'),
                ],
            ]);

            if ($session->status === 'open') {
                Log::info('Stripe payment session created', [
                    'session_id' => $session->id,
                    'payment_intent' => $session->payment_intent,
                    'amount' => $this->amount,
                ]);

                return [
                    'success' => true,
                    'redirect_url' => $session->url,
                    'payment_id' => $session->payment_intent,
                    'message' => 'Payment session created successfully',
                ];
            }

            return [
                'success' => false,
                'redirect_url' => '',
                'payment_id' => '',
                'message' => 'Failed to create payment session',
            ];

        } catch (ApiErrorException $e) {
            Log::error('Stripe API error: ' . $e->getMessage(), [
                'code' => $e->getStripeCode(),
            ]);

            return [
                'success' => false,
                'redirect_url' => '',
                'payment_id' => '',
                'message' => 'Payment service error: ' . $e->getMessage(),
            ];

        } catch (\Exception $e) {
            Log::error('Stripe payment error: ' . $e->getMessage());

            return [
                'success' => false,
                'redirect_url' => '',
                'payment_id' => '',
                'message' => 'Payment service temporarily unavailable',
            ];
        }
    }

    /**
     * Verify a payment transaction
     */
    public function paymentConfirmation($payment_id)
    {
        try {
            $paymentIntent = $this->stripeClient->paymentIntents->retrieve($payment_id);

            Log::info('Stripe payment verification', [
                'payment_intent' => $payment_id,
                'status' => $paymentIntent->status,
            ]);

            if ($paymentIntent->status === 'succeeded') {
                return [
                    'success' => true,
                    'data' => [
                        'amount' => $paymentIntent->amount_received / 100, // Convert from cents
                        'currency' => strtoupper($paymentIntent->currency),
                        'payment_status' => 'success',
                        'payment_method' => STRIPE,
                        'transaction_id' => $paymentIntent->id,
                    ],
                ];
            }

            return [
                'success' => false,
                'data' => [
                    'amount' => $paymentIntent->amount / 100,
                    'currency' => strtoupper($paymentIntent->currency),
                    'payment_status' => 'unpaid',
                    'payment_method' => STRIPE,
                ],
            ];

        } catch (ApiErrorException $e) {
            Log::error('Stripe verification API error: ' . $e->getMessage());

            return [
                'success' => false,
                'data' => [
                    'amount' => 0,
                    'currency' => $this->currency,
                    'payment_status' => 'error',
                    'payment_method' => STRIPE,
                ],
            ];

        } catch (\Exception $e) {
            Log::error('Stripe verification error: ' . $e->getMessage());

            return [
                'success' => false,
                'data' => [
                    'amount' => 0,
                    'currency' => $this->currency,
                    'payment_status' => 'error',
                    'payment_method' => STRIPE,
                ],
            ];
        }
    }

    /**
     * Verify Stripe webhook signature
     */
    public static function verifyWebhookSignature(string $payload, string $signature, string $endpointSecret): bool
    {
        try {
            \Stripe\Webhook::constructEvent($payload, $signature, $endpointSecret);
            return true;
        } catch (\Exception $e) {
            Log::warning('Stripe webhook signature verification failed: ' . $e->getMessage());
            return false;
        }
    }
}
