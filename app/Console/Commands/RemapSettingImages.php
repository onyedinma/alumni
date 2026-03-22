<?php

namespace App\Console\Commands;

use App\Models\FileManager;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RemapSettingImages extends Command
{
    protected $signature = 'settings:remap-images';
    protected $description = 'Remap setting image values to new FileManager IDs after restore';

    public function handle()
    {
        // Get all image-related settings
        $imageSettings = DB::table('settings')
            ->where(function ($query) {
                $query->where('option_key', 'like', '%logo%')
                    ->orWhere('option_key', 'like', '%icon%')
                    ->orWhere('option_key', 'like', '%image%')
                    ->orWhere('option_key', 'like', '%preloader%')
                    ->orWhere('option_key', 'like', '%crest%');
            })
            ->get();

        $this->info("Found " . count($imageSettings) . " image-related settings.");

        // Get all Setting FileManager entries
        $settingFiles = FileManager::where('path', 'like', 'uploads/Setting/%')
            ->get()
            ->keyBy('file_name');

        $this->info("Found " . $settingFiles->count() . " Setting FileManager entries.");

        $updated = 0;
        $skipped = 0;

        foreach ($imageSettings as $setting) {
            $oldValue = $setting->option_value;

            // Skip if value is empty or not numeric (might be a path or URL)
            if (empty($oldValue)) {
                $skipped++;
                continue;
            }

            // Try to find the file in FileManager by the old ID stored in settings
            // Since old IDs are lost, we need a different approach
            // Let's check if the old value is an existing FileManager ID
            $existingFile = FileManager::find($oldValue);
            if ($existingFile) {
                $this->info("{$setting->option_key}: Already valid (ID: $oldValue)");
                $skipped++;
                continue;
            }

            // If not found, we need admin to manually re-upload
            $this->warn("{$setting->option_key}: Old ID $oldValue not found. Manual re-upload required.");
            $skipped++;
        }

        $this->info("Done! Updated: $updated, Skipped: $skipped");
        $this->warn("NOTE: Settings with missing IDs need to be manually re-uploaded via Admin Panel.");

        return 0;
    }
}
