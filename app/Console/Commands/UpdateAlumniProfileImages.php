<?php

namespace App\Console\Commands;

use App\Models\Alumni;
use App\Models\FileManager;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UpdateAlumniProfileImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alumni:update-profile-images 
                            {folder : Path to folder containing profile images named by email}
                            {--dry-run : Show what would be done without making changes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update alumni profile images from a folder of images named by email address';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $folderPath = $this->argument('folder');
        $dryRun = $this->option('dry-run');

        if (!File::isDirectory($folderPath)) {
            $this->error("Folder not found: {$folderPath}");
            return 1;
        }

        $this->info("Scanning folder: {$folderPath}");
        if ($dryRun) {
            $this->warn("DRY RUN MODE - No changes will be made");
        }

        // Get all image files in the folder
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'heic', 'JPG', 'JPEG', 'PNG', 'HEIC'];
        $files = File::files($folderPath);

        $updated = 0;
        $notFound = 0;
        $errors = 0;

        foreach ($files as $file) {
            $filename = $file->getFilename();
            $extension = $file->getExtension();

            // Skip non-image files
            if (!in_array(strtolower($extension), array_map('strtolower', $imageExtensions))) {
                $this->line("Skipping non-image: {$filename}");
                continue;
            }

            // Extract email from filename (remove extension)
            $email = $this->extractEmailFromFilename($filename);

            if (!$email) {
                $this->warn("Could not extract email from: {$filename}");
                $errors++;
                continue;
            }

            // Find user by email (case-insensitive)
            $user = User::whereRaw('LOWER(email) = ?', [strtolower($email)])->first();

            if (!$user) {
                $this->warn("No user found for email: {$email}");
                $notFound++;
                continue;
            }

            // Find alumni record
            $alumni = Alumni::where('user_id', $user->id)->first();

            if (!$alumni) {
                $this->warn("No alumni record found for user: {$user->name} ({$email})");
                $notFound++;
                continue;
            }

            if ($dryRun) {
                $this->info("[DRY RUN] Would update: {$user->name} ({$email}) with {$filename}");
                $updated++;
                continue;
            }

            try {
                // Copy image to storage
                $newFilename = 'user_' . $user->id . '_' . time() . '_' . Str::random(6) . '.' . strtolower($extension);
                $destinationPath = storage_path('app/public/users/' . $newFilename);

                // Ensure directory exists
                if (!File::isDirectory(storage_path('app/public/users'))) {
                    File::makeDirectory(storage_path('app/public/users'), 0755, true);
                }

                // Copy the file
                File::copy($file->getPathname(), $destinationPath);

                // Create FileManager record
                $fileManager = FileManager::create([
                    'tenant_id' => $user->tenant_id ?? getTenantId(),
                    'original_name' => $filename,
                    'file_name' => $newFilename,
                    'file_type' => 'image/' . strtolower($extension),
                    'file_size' => $file->getSize(),
                    'path' => 'users/' . $newFilename,
                    'disk' => 'public',
                    'folder_name' => 'users',
                ]);

                // Update alumni record with new file reference
                $alumni->file = $fileManager->id;
                $alumni->save();

                $this->info("Updated: {$user->name} ({$email})");
                $updated++;

            } catch (\Exception $e) {
                $this->error("Error updating {$email}: " . $e->getMessage());
                $errors++;
            }
        }

        $this->newLine();
        $this->info("=== Summary ===");
        $this->info("Updated: {$updated}");
        $this->warn("Not found: {$notFound}");
        $this->error("Errors: {$errors}");

        return 0;
    }

    /**
     * Extract email from filename
     */
    private function extractEmailFromFilename(string $filename): ?string
    {
        // Remove common image extensions
        $extensions = ['.jpg', '.jpeg', '.png', '.gif', '.webp', '.heic', '.JPG', '.JPEG', '.PNG', '.HEIC'];

        $email = $filename;
        foreach ($extensions as $ext) {
            if (Str::endsWith($email, $ext)) {
                $email = Str::replaceLast($ext, '', $email);
                break;
            }
        }

        // Handle filenames like "email (2).jpg" - remove the (2) part
        $email = preg_replace('/\s*\(\d+\)$/', '', $email);

        // Check if it looks like an email
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $email;
        }

        // Try to find email pattern in the filename
        if (preg_match('/([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})/', $filename, $matches)) {
            return $matches[1];
        }

        return null;
    }
}
