<?php

namespace App\Http\Services\Payment;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FlutterwaveService extends BasePaymentService
{
    private string $baseUrl = 'https://api.flutterwave.com/v3';
    private ?string $orderId;
    private string $publicKey;
    private string $secretKey;
    private string $encryptionKey;

    public function __construct($method, $object)
    {
        parent::__construct($method, $object);

        $this->orderId = $object['id'] ?? null;
        $this->publicKey = $this->gateway->key;
        $this->secretKey = $this->gateway->secret;
        $this->encryptionKey = $this->gateway->url;
    }

    /**
     * Initialize a payment transaction
     */
    public function makePayment($amount)
    {
        $this->setAmount($amount);

        try {
            // Verify currency is supported
            $this->verifyCurrency();

            $txRef = $this->generateReference();

            $response = Http::withToken($this->secretKey)
                ->timeout(30)
                ->post("{$this->baseUrl}/payments", [
                    'tx_ref' => $txRef,
                    'amount' => $this->amount,
                    'currency' => $this->currency,
                    'redirect_url' => $this->callbackUrl,
                    'payment_options' => 'card,banktransfer,ussd',
                    'customer' => [
                        'email' => auth()->user()->email,
                        'name' => auth()->user()->name,
                    ],
                    'meta' => [
                        'order_id' => $this->orderId,
                    ],
                    'customizations' => [
                        'title' => config('app.name', 'Alumni Platform'),
                        'description' => 'Payment for services',
                    ],
                ]);

            if ($response->successful() && $response->json('status') === 'success') {
                $data = $response->json('data');

                Log::info('Flutterwave payment initialized', [
                    'tx_ref' => $txRef,
                    'amount' => $this->amount,
                    'currency' => $this->currency,
                ]);

                return [
                    'success' => true,
                    'redirect_url' => $data['link'],
                    'payment_id' => $txRef,
                    'message' => 'Payment initialized successfully',
                ];
            }

            Log::error('Flutterwave initialization failed', [
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
            Log::error('Flutterwave payment error: ' . $e->getMessage());

            return [
                'success' => false,
                'redirect_url' => '',
                'payment_id' => '',
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * Verify a payment transaction
     */
    public function paymentConfirmation($payment_id)
    {
        try {
            // Wait for transaction to process
            sleep(3);

            $response = Http::withToken($this->secretKey)
                ->timeout(30)
                ->get("{$this->baseUrl}/transactions", [
                    'tx_ref' => $payment_id,
                ]);

            Log::info('Flutterwave verification response', ['response' => $response->json()]);

            if ($response->successful() && $response->json('status') === 'success') {
                $transactions = $response->json('data');

                if (!empty($transactions) && $transactions[0]['status'] === 'successful') {
                    $transaction = $transactions[0];

                    return [
                        'success' => true,
                        'data' => [
                            'amount' => $transaction['amount'],
                            'currency' => $transaction['currency'],
                            'payment_status' => 'success',
                            'payment_method' => FLUTTERWAVE,
                            'transaction_id' => $transaction['id'],
                        ],
                    ];
                }
            }

            return [
                'success' => false,
                'data' => [
                    'amount' => 0,
                    'currency' => $this->currency,
                    'payment_status' => 'unpaid',
                    'payment_method' => FLUTTERWAVE,
                ],
            ];

        } catch (\Exception $e) {
            Log::error('Flutterwave verification error: ' . $e->getMessage());

            return [
                'success' => false,
                'data' => [
                    'amount' => 0,
                    'currency' => $this->currency,
                    'payment_status' => 'error',
                    'payment_method' => FLUTTERWAVE,
                ],
            ];
        }
    }

    /**
     * Verify webhook signature
     */
    public static function verifyWebhookSignature(string $payload, string $signature): bool
    {
        $gateway = \App\Models\Gateway::where('slug', 'flutterwave')
            ->where('tenant_id', getTenantId())
            ->first();

        if (!$gateway || !$gateway->url) {
            return false;
        }

        return hash_equals($gateway->url, $signature);
    }

    /**
     * Generate unique payment reference
     */
    private function generateReference(): string
    {
        return 'FLW_' . time() . '_' . bin2hex(random_bytes(8));
    }

    /**
     * Verify currency is supported
     */
    private function verifyCurrency(): void
    {
        if (!in_array($this->currency, $this->supportedCurrencies())) {
            throw new \Exception("{$this->currency} is not supported by Flutterwave");
        }
    }

    /**
     * Get list of supported currencies
     */
    public function supportedCurrencies(): array
    {
        return [
            'NGN',
            'USD',
            'EUR',
            'GBP',
            'GHS',
            'KES',
            'UGX',
            'TZS',
            'ZAR',
            'RWF',
            'XAF',
            'XOF',
            'ZMW',
            'MWK',
            'EGP',
            'MAD'
        ];
    }

    /**
     * Get gateway name
     */
    public function gatewayName(): string
    {
        return 'flutterwave';
    }
}
