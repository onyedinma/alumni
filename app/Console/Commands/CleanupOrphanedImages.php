<?php

namespace App\Console\Commands;

use App\Models\FileManager;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CleanupOrphanedImages extends Command
{
    protected $signature = 'cleanup:orphaned-images {--dry-run : Show what would be deleted without actually deleting}';
    protected $description = 'Delete image files in storage that are not referenced by FileManager';

    public function handle()
    {
        $folder = storage_path('app/public/users');
        $dryRun = $this->option('dry-run');

        if (!File::isDirectory($folder)) {
            $this->error("Folder not found: {$folder}");
            return 1;
        }

        $files = File::files($folder);
        $deleted = 0;
        $kept = 0;

        foreach ($files as $file) {
            $filename = $file->getFilename();

            // Check if this file is referenced in FileManager
            $exists = FileManager::where('file_name', $filename)->exists();

            if (!$exists) {
                if ($dryRun) {
                    $this->warn("[DRY RUN] Would delete: {$filename}");
                } else {
                    File::delete($file->getPathname());
                    $this->info("Deleted: {$filename}");
                }
                $deleted++;
            } else {
                $kept++;
            }
        }

        $this->newLine();
        $this->info("=== Summary ===");
        $this->info("Kept (referenced): {$kept}");
        $this->warn("Deleted (orphaned): {$deleted}");

        return 0;
    }
}
