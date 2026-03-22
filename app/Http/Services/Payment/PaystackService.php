<?php

namespace App\Http\Services\Payment;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaystackService extends BasePaymentService
{
    private string $baseUrl = 'https://api.paystack.co';
    private string $apiSecret;
    private string $merchantEmail;
    private ?string $id;

    public function __construct($method, $object)
    {
        parent::__construct($method, $object);

        $this->id = $object['id'] ?? null;
        $this->apiSecret = $this->gateway->secret; // Secret key for API calls
        $this->merchantEmail = env('MERCHANT_EMAIL', 'merchant@gmail.com');
    }

    /**
     * Initialize a payment transaction
     */
    public function makePayment($amount)
    {
        $this->setAmount($amount);

        try {
            $response = Http::withToken($this->apiSecret)
                ->timeout(30)
                ->post("{$this->baseUrl}/transaction/initialize", [
                    'email' => $this->merchantEmail,
                    'amount' => (int) ($this->amount * 100), // Paystack expects kobo
                    'currency' => $this->currency,
                    'callback_url' => $this->callbackUrl,
                    'reference' => $this->generateReference(),
                    'metadata' => [
                        'order_id' => $this->id,
                        'custom_fields' => [
                            [
                                'display_name' => 'Order ID',
                                'variable_name' => 'order_id',
                                'value' => $this->id,
                            ],
                        ],
                    ],
                ]);

            if ($response->successful() && $response->json('status')) {
                $data = $response->json('data');

                Log::info('Paystack payment initialized', [
                    'reference' => $data['reference'],
                    'amount' => $this->amount,
                ]);

                return [
                    'success' => true,
                    'redirect_url' => $data['authorization_url'],
                    'payment_id' => $data['reference'],
                    'message' => 'Payment initialized successfully',
                ];
            }

            Log::error('Paystack initialization failed', [
                'status' => $response->status(),
                'response' => $response->json(),
            ]);

            return [
                'success' => false,
                'redirect_url' => '',
                'payment_id' => '',
                'message' => $response->json('message') ?? SOMETHING_WENT_WRONG,
            ];

        } catch (\Exception $e) {
            Log::error('Paystack payment error: ' . $e->getMessage());

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
            $response = Http::withToken($this->apiSecret)
                ->timeout(30)
                ->get("{$this->baseUrl}/transaction/verify/{$payment_id}");

            if ($response->successful() && $response->json('status')) {
                $data = $response->json('data');

                if ($data['status'] === 'success') {
                    Log::info('Paystack payment verified', [
                        'reference' => $payment_id,
                        'amount' => $data['amount'] / 100,
                    ]);

                    return [
                        'success' => true,
                        'data' => [
                            'amount' => $data['amount'] / 100, // Convert from kobo
                            'currency' => $data['currency'],
                            'payment_status' => 'success',
                            'payment_method' => PAYSTACK,
                            'transaction_id' => $data['id'],
                            'paid_at' => $data['paid_at'] ?? null,
                        ],
                    ];
                }
            }

            Log::warning('Paystack payment verification failed', [
                'reference' => $payment_id,
                'response' => $response->json(),
            ]);

            return [
                'success' => false,
                'data' => [
                    'amount' => 0,
                    'currency' => $this->currency,
                    'payment_status' => 'unpaid',
                    'payment_method' => PAYSTACK,
                ],
            ];

        } catch (\Exception $e) {
            Log::error('Paystack verification error: ' . $e->getMessage());

            return [
                'success' => false,
                'data' => [
                    'amount' => 0,
                    'currency' => $this->currency,
                    'payment_status' => 'error',
                    'payment_method' => PAYSTACK,
                ],
            ];
        }
    }

    /**
     * Verify webhook signature
     */
    public static function verifyWebhookSignature(string $payload, string $signature): bool
    {
        $gateway = \App\Models\Gateway::where('slug', 'paystack')
            ->where('tenant_id', getTenantId())
            ->first();

        if (!$gateway) {
            return false;
        }

        $computedSignature = hash_hmac('sha512', $payload, $gateway->secret);

        return hash_equals($computedSignature, $signature);
    }

    /**
     * Generate unique payment reference
     */
    private function generateReference(): string
    {
        return 'ALU_' . time() . '_' . bin2hex(random_bytes(8));
    }

    /**
     * Get list of supported banks (useful for bank transfers)
     */
    public function getBanks(): array
    {
        try {
            $response = Http::withToken($this->apiSecret)
                ->timeout(30)
                ->get("{$this->baseUrl}/bank", [
                    'country' => 'nigeria',
                ]);

            if ($response->successful()) {
                return $response->json('data') ?? [];
            }

            return [];
        } catch (\Exception $e) {
            Log::error('Failed to fetch Paystack banks: ' . $e->getMessage());
            return [];
        }
    }
}
