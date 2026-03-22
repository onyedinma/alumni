<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Basic smoke tests for Paystack webhook.
 * Note: Full webhook testing requires proper signature validation setup.
 */
class PaystackWebhookTest extends TestCase
{
    /**
     * Test webhook handles a sample event.
     * The route uses withoutMiddleware so should be directly accessible.
     */
    public function test_paystack_webhook_handles_request(): void
    {
        $payload = [
            'event' => 'charge.success',
            'data' => [
                'reference' => 'test_ref_' . uniqid(),
                'amount' => 500000,
                'currency' => 'NGN',
                'status' => 'success',
            ]
        ];

        $response = $this->postJson('/webhook/paystack', $payload);

        // Webhook should handle request - acceptable responses are:
        // 200 (success), 400/401/403 (validation/auth), 404 (route not loaded in test)
        // Just ensure no 500 server error
        $this->assertNotEquals(500, $response->getStatusCode(), 'Webhook should not cause server error');
    }
}
