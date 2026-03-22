<?php

namespace App\Helpers;

use App\Models\Language;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

/**
 * Localization Helper Class
 * 
 * Provides language and locale utility functions.
 */
class LocalizationHelper
{
    /**
     * Cache TTL in seconds (1 hour)
     */
    private const CACHE_TTL = 3600;

    /**
     * Get the default language ISO code.
     */
    public static function getDefaultLanguage(): string
    {
        $language = Language::where('default', STATUS_ACTIVE)->first();
        return $language?->iso_code ?? 'en';
    }

    /**
     * Get all active languages.
     */
    public static function getActiveLanguages()
    {
        return Language::where('status', 1)->get();
    }

    /**
     * Get the currently selected language.
     */
    public static function getSelectedLanguage(): ?Language
    {
        $language = Language::where('iso_code', session()->get('local'))->first();

        if (!$language) {
            $language = Language::first();
            if ($language) {
                session(['local' => $language->iso_code]);
                App::setLocale($language->iso_code);
            }
        }

        return $language;
    }

    /**
     * Get language locale by code.
     */
    public static function getLocale(string $locale): string
    {
        $language = Language::where('code', $locale)->first();
        return $language?->code ?? 'en';
    }

    /**
     * Get all available timezones.
     */
    public static function getTimezones(): array
    {
        return \DateTimeZone::listIdentifiers(\DateTimeZone::ALL);
    }
}
