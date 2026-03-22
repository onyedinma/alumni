<?php

namespace App\Console\Commands;

use App\Models\FileManager;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class RestoreFileManagerEntries extends Command
{
    protected $signature = 'files:restore {folder? : Specific subfolder in uploads to scan}';
    protected $description = 'Scan storage/app/public/uploads and recreate missing FileManager entries';

    public function handle()
    {
        $folder = $this->argument('folder');
        $basePath = 'uploads';

        if ($folder) {
            $basePath = 'uploads/' . $folder;
        }

        $this->info("Scanning $basePath...");

        $files = Storage::disk('public')->allFiles($basePath);
        $this->info("Found " . count($files) . " files.");

        $created = 0;
        $skipped = 0;

        foreach ($files as $filePath) {
            // Check if FileManager entry already exists for this path
            $existing = FileManager::where('path', $filePath)->first();
            if ($existing) {
                $skipped++;
                continue;
            }

            // Get file info
            $fileName = basename($filePath);
            $extension = pathinfo($fileName, PATHINFO_EXTENSION);
            $size = Storage::disk('public')->size($filePath);
            $mimeType = $this->guessMimeType($extension);

            // Create FileManager entry
            $fileManager = new FileManager();
            $fileManager->tenant_id = 1;
            $fileManager->file_type = $mimeType;
            $fileManager->storage_type = 'public';
            $fileManager->original_name = $fileName;
            $fileManager->file_name = $fileName;
            $fileManager->path = $filePath;
            $fileManager->extension = $extension;
            $fileManager->size = $size;
            $fileManager->save();

            $this->info("Created ID {$fileManager->id} for: $filePath");
            $created++;
        }

        $this->info("Done! Created: $created, Skipped (existing): $skipped");
        return 0;
    }

    private function guessMimeType(string $extension): string
    {
        $map = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'webp' => 'image/webp',
            'svg' => 'image/svg+xml',
            'pdf' => 'application/pdf',
        ];

        return $map[strtolower($extension)] ?? 'application/octet-stream';
    }
}
