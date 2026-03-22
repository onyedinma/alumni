<?php

namespace App\Helpers;

use App\Models\FileManager;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

/**
 * Settings Helper Class
 * 
 * Provides settings-related utility functions with caching.
 */
class SettingsHelper
{
    /**
     * Cache TTL in seconds (1 hour)
     */
    private const CACHE_TTL = 3600;

    /**
     * Get a setting value by key with caching.
     */
    public static function get(string $optionKey, mixed $default = null): mixed
    {
        $settings = config('settings');

        if ($optionKey && isset($settings[$optionKey])) {
            return $settings[$optionKey];
        }

        return $default;
    }

    /**
     * Get a setting image URL by option key.
     */
    public static function getImage(string $optionKey): string
    {
        if (!$optionKey) {
            return FileHelper::getDefaultImage();
        }

        $tenantId = getTenantId();
        $setting = Setting::where('tenant_id', $tenantId)
            ->where('option_key', $optionKey)
            ->first();

        if (!isset($setting->option_value) || !$setting->option_value) {
            return FileHelper::getDefaultImage();
        }

        $file = FileManager::where('tenant_id', $tenantId)
            ->select('path', 'storage_type')
            ->find($setting->option_value);

        if (!$file) {
            return FileHelper::getDefaultImage();
        }

        return FileHelper::resolveFileUrl($file->path, $file->storage_type);
    }

    /**
     * Get a setting image URL for central (no tenant).
     */
    public static function getImageCentral(string $optionKey): string
    {
        if (!$optionKey) {
            return FileHelper::getDefaultImage();
        }

        $setting = Setting::whereNull('tenant_id')
            ->where('option_key', $optionKey)
            ->first();

        if (!isset($setting->option_value) || !$setting->option_value) {
            return FileHelper::getDefaultImage();
        }

        $file = FileManager::whereNull('tenant_id')
            ->select('path', 'storage_type')
            ->find($setting->option_value);

        if (!$file) {
            return FileHelper::getDefaultImage();
        }

        return FileHelper::resolveFileUrl($file->path, $file->storage_type);
    }

    /**
     * Store or update a setting image.
     */
    public static function storeImage(?int $optionValue, $requestFile): ?int
    {
        if (!$requestFile) {
            return null;
        }

        $tenantId = getTenantId();

        if ($optionValue) {
            $fileManager = FileManager::where('tenant_id', $tenantId)
                ->where('id', $optionValue)
                ->first();

            if ($fileManager) {
                $fileManager->removeFile();
                $uploaded = $fileManager->upload('Setting', $requestFile, '', $fileManager->id);
            } else {
                $fileManager = new FileManager();
                $uploaded = $fileManager->upload('Setting', $requestFile);
            }
        } else {
            $fileManager = new FileManager();
            $uploaded = $fileManager->upload('Setting', $requestFile);
        }

        return $uploaded->id;
    }

    /**
     * Get build version.
     */
    public static function getBuildVersion(): int
    {
        $buildVersion = self::get('build_version');
        return is_null($buildVersion) ? 1 : (int) $buildVersion;
    }

    /**
     * Set build version.
     */
    public static function setBuildVersion(int $version): void
    {
        $option = Setting::firstOrCreate(['option_key' => 'build_version']);
        $option->option_value = $version;
        $option->save();
    }

    /**
     * Set current version.
     */
    public static function setCurrentVersion(): void
    {
        $option = Setting::firstOrCreate(['option_key' => 'current_version']);
        $option->option_value = config('app.current_version');
        $option->save();
    }
}
