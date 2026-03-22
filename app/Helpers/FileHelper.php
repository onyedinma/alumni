<?php

namespace App\Helpers;

use App\Models\FileManager;
use Illuminate\Support\Facades\Storage;

/**
 * File Helper Class
 * 
 * Provides file-related utility functions for storage operations.
 */
class FileHelper
{
    /**
     * Get a file URL by FileManager ID.
     */
    public static function getUrl(?int $id): string
    {
        if (!$id) {
            return self::getDefaultImage();
        }

        $file = FileManager::select('path', 'storage_type')->find($id);

        if (!$file) {
            return self::getDefaultImage();
        }

        return self::resolveFileUrl($file->path, $file->storage_type);
    }

    /**
     * Resolve a file URL from path and storage type.
     */
    public static function resolveFileUrl(?string $path, string $storageType): string
    {
        if (!$path || !Storage::disk($storageType)->exists($path)) {
            return self::getDefaultImage();
        }

        if ($storageType === 'public') {
            return asset('storage/' . $path);
        }

        if ($storageType === 'wasabi') {
            return Storage::disk('wasabi')->url($path);
        }

        return Storage::disk($storageType)->url($path);
    }

    /**
     * Get the default placeholder image.
     */
    public static function getDefaultImage(): string
    {
        return asset('assets/images/no-image.jpg');
    }

    /**
     * Get the default upload image icon.
     */
    public static function getUploadIcon(): string
    {
        return asset('assets/images/icon/upload-img-1.svg');
    }

    /**
     * Format file size in human-readable format.
     */
    public static function humanFileSize(int $size, string $unit = ''): string
    {
        if ((!$unit && $size >= 1 << 30) || $unit === 'GB') {
            return number_format($size / (1 << 30), 2) . 'GB';
        }

        if ((!$unit && $size >= 1 << 20) || $unit === 'MB') {
            return number_format($size / (1 << 20), 2) . 'MB';
        }

        if ((!$unit && $size >= 1 << 10) || $unit === 'KB') {
            return number_format($size / (1 << 10), 2) . 'KB';
        }

        return number_format($size) . ' bytes';
    }
}
