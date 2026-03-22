<?php

namespace App\Services;

use App\Models\GatewayCurrency;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class ExchangeRateService
{
    /**
     * Free API: ExchangeRate-API (1,500 requests/month free)
     */
    private string $apiUrl = 'https://api.exchangerate-api.com/v4/latest/';

    /**
     * Base currency for the system
     */
    private string $baseCurrency;

    /**
     * Rate margin/buffer percentage (e.g., 0.02 = 2%)
     */
    private float $margin;

    public function __construct()
    {
        $this->baseCurrency = getOption('base_currency', 'USD');
        $this->margin = (float) getOption('exchange_rate_margin', 2) / 100;
    }

    /**
     * Fetch latest exchange rates from API
     */
    public function fetchRates(): ?array
    {
        try {
            $response = Http::timeout(30)->get($this->apiUrl . $this->baseCurrency);

            if ($response->successful()) {
                $data = $response->json();

                Log::info('Exchange rates fetched successfully', [
                    'base' => $data['base'] ?? $this->baseCurrency,
                    'date' => $data['date'] ?? now()->toDateString(),
                ]);

                return $data['rates'] ?? null;
            }

            Log::error('Failed to fetch exchange rates', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return null;
        } catch (\Exception $e) {
            Log::error('Exchange rate API error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Update all gateway currencies with new rates
     */
    public function updateGatewayCurrencies(): array
    {
        $rates = $this->fetchRates();

        if (!$rates) {
            return [
                'success' => false,
                'message' => 'Failed to fetch exchange rates',
                'updated' => 0,
            ];
        }

        $updated = 0;
        $currencies = GatewayCurrency::all();

        foreach ($currencies as $gatewayCurrency) {
            $currency = strtoupper($gatewayCurrency->currency);

            if (isset($rates[$currency])) {
                // Apply margin for buffer against fluctuations
                $rateWithMargin = $rates[$currency] * (1 + $this->margin);

                $gatewayCurrency->update([
                    'conversion_rate' => round($rateWithMargin, 4),
                ]);

                $updated++;

                Log::info("Updated {$currency} rate", [
                    'original_rate' => $rates[$currency],
                    'with_margin' => $rateWithMargin,
                ]);
            }
        }

        // Store last update timestamp
        \App\Models\Setting::updateOrCreate(
            ['option_key' => 'exchange_rates_updated_at', 'tenant_id' => getTenantId()],
            ['option_value' => now()->toIso8601String()]
        );

        return [
            'success' => true,
            'message' => "Updated {$updated} currency rates",
            'updated' => $updated,
            'rates' => $rates,
        ];
    }

    /**
     * Get cached rates (refresh every 24 hours)
     */
    public function getCachedRates(): ?array
    {
        return Cache::remember('exchange_rates', 86400, function () {
            return $this->fetchRates();
        });
    }

    /**
     * Get rate for specific currency
     */
    public function getRate(string $currency): ?float
    {
        $rates = $this->getCachedRates();

        if (!$rates || !isset($rates[strtoupper($currency)])) {
            return null;
        }

        return $rates[strtoupper($currency)] * (1 + $this->margin);
    }

    /**
     * Convert amount from base currency to target currency
     */
    public function convert(float $amount, string $toCurrency): ?float
    {
        $rate = $this->getRate($toCurrency);

        if (!$rate) {
            return null;
        }

        return round($amount * $rate, 2);
    }

    /**
     * Get last update timestamp
     */
    public function getLastUpdate(): ?string
    {
        return getOption('exchange_rates_updated_at');
    }
}
