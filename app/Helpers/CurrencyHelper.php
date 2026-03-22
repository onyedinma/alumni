<?php

namespace App\Helpers;

use App\Models\Currency;
use Illuminate\Support\Facades\Cache;

/**
 * Currency Helper Class
 * 
 * Provides currency-related utility functions with caching for performance.
 */
class CurrencyHelper
{
    /**
     * Cache TTL in seconds (1 hour)
     */
    private const CACHE_TTL = 3600;

    /**
     * Get the current currency for the tenant with caching.
     */
    public static function getCurrentCurrency(?int $tenantId = null): ?Currency
    {
        $tenantId = $tenantId ?? getTenantId();
        $cacheKey = "currency_{$tenantId}";

        return Cache::remember($cacheKey, self::CACHE_TTL, function () use ($tenantId) {
            return Currency::where('tenant_id', $tenantId)
                ->where('current_currency', STATUS_ACTIVE)
                ->first();
        });
    }

    /**
     * Get the currency symbol.
     */
    public static function getSymbol(?int $tenantId = null): string
    {
        $currency = self::getCurrentCurrency($tenantId);
        return $currency?->symbol ?? '';
    }

    /**
     * Get the currency ISO code.
     */
    public static function getIsoCode(?int $tenantId = null): string
    {
        $currency = self::getCurrentCurrency($tenantId);
        return $currency?->currency_code ?? '';
    }

    /**
     * Get the currency placement (before/after).
     */
    public static function getPlacement(?int $tenantId = null): string
    {
        $currency = self::getCurrentCurrency($tenantId);
        return $currency?->currency_placement ?? 'before';
    }

    /**
     * Format a price with currency symbol.
     */
    public static function formatPrice(float $price, ?int $tenantId = null): string
    {
        $formatted = number_format($price, 2, '.', '');
        $symbol = self::getSymbol($tenantId);
        $placement = self::getPlacement($tenantId);

        if ($placement === 'after') {
            return $formatted . $symbol;
        }

        return $symbol . $formatted;
    }

    /**
     * Format a number with 2 decimal places.
     */
    public static function formatNumber(float $amount): string
    {
        return number_format($amount, 2, '.', '');
    }

    /**
     * Convert decimal to integer (for payment gateways).
     */
    public static function decimalToInt(float $amount): int
    {
        return (int) number_format($amount * 100, 0, '.', '');
    }

    /**
     * Convert integer to decimal (from payment gateways).
     */
    public static function intToDecimal(int $amount): string
    {
        return number_format($amount / 100, 2, '.', '');
    }

    /**
     * Clear the currency cache for a tenant.
     */
    public static function clearCache(?int $tenantId = null): void
    {
        $tenantId = $tenantId ?? getTenantId();
        Cache::forget("currency_{$tenantId}");
    }
}
