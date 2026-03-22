<?php

namespace App\Console\Commands;

use App\Models\Alumni;
use App\Models\House;
use App\Models\SchoolClass;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ImportAlumniFromCsv extends Command
{
    protected $signature = 'alumni:import-csv {file : Path to the CSV file}';
    protected $description = 'Import alumni data from CSV file (converted from FGCO Excel)';

    private $classes = [];
    private $houses = [];

    public function handle()
    {
        $filePath = $this->argument('file');

        if (!file_exists($filePath)) {
            $this->error("File not found: {$filePath}");
            return 1;
        }

        $this->info("Loading CSV file...");

        // Cache mappings
        $this->classes = SchoolClass::pluck('id', 'name')->toArray();
        $this->houses = House::pluck('id', 'name')->toArray();

        $this->info("Available classes: " . implode(', ', array_keys($this->classes)));
        $this->info("Available houses: " . implode(', ', array_keys($this->houses)));

        $handle = fopen($filePath, 'r');
        $headers = fgetcsv($handle); // Read headers

        $successCount = 0;
        $skippedCount = 0;
        $rowIndex = 1;

        DB::beginTransaction();

        try {
            while (($row = fgetcsv($handle)) !== false) {
                $rowIndex++;
                $result = $this->importRow($row, $rowIndex);
                if ($result) {
                    $successCount++;
                } else {
                    $skippedCount++;
                }
            }

            fclose($handle);
            DB::commit();
            $this->info("Import complete! Success: {$successCount}, Skipped: {$skippedCount}");
            return 0;

        } catch (\Exception $e) {
            DB::rollBack();
            fclose($handle);
            $this->error("Import failed: " . $e->getMessage());
            $this->error($e->getTraceAsString());
            return 1;
        }
    }

    private function importRow(array $row, int $rowIndex): bool
    {
        // Column mapping based on Excel structure (now CSV):
        // 0: Timestamp, 1: Image/Photo, 2: Full Name, 3: Nick Name, 4: Email, 5: Phone
        // 6: First Year Class, 7: Final Year Class, 8: First House, 9: Final House
        // 10: DOB, 11: Country, 12: State, 13: State of Origin, 14: LGA
        // 15: Address, 16: Current Job, 17: Expertise, 18: Company, 19: Designation
        // 20: Work Address, 21: Portfolio/Bio

        $name = trim($row[2] ?? '');
        $email = trim($row[4] ?? '');
        $nickname = trim($row[3] ?? '');

        if (empty($name) || empty($email)) {
            $this->warn("Row {$rowIndex}: Skipping - missing name or email");
            return false;
        }

        if (User::where('email', $email)->exists()) {
            $this->warn("Row {$rowIndex}: Skipping - email already exists: {$email}");
            return false;
        }

        // Use nickname as password, fallback to '12345678' if empty
        $password = !empty($nickname) ? $nickname : '12345678';

        // Create User
        $user = User::create([
            'tenant_id' => 1, // Default Tenant
            'name' => $name,
            'email' => $email,
            'mobile' => trim($row[5] ?? ''),
            'nick_name' => $nickname,
            'password' => Hash::make($password),
            'role' => USER_ROLE_ALUMNI,
            'email_verified_at' => now(),
            'status' => STATUS_ACTIVE,
        ]);

        // Handle Image Download
        $imageUrl = trim($row[1] ?? '');
        if (!empty($imageUrl) && filter_var($imageUrl, FILTER_VALIDATE_URL)) {
            $this->downloadAndSaveImage($user, $imageUrl);
        }

        // Map Classes/Houses
        $firstClassName = trim($row[6] ?? '');
        $finalClassName = trim($row[7] ?? '');
        $firstHouseName = trim($row[8] ?? '');
        $finalHouseName = trim($row[9] ?? '');

        $firstClassId = $this->findClassId($firstClassName);
        $finalClassId = $this->findClassId($finalClassName);
        $firstHouseId = $this->findHouseId($firstHouseName);
        $finalHouseId = $this->findHouseId($finalHouseName);

        // Create Alumni
        $alumni = new Alumni();
        $alumni->tenant_id = 1; // Default Tenant
        $alumni->user_id = $user->id;
        $alumni->first_class_id = $firstClassId;
        $alumni->final_class_id = $finalClassId;
        $alumni->first_house_id = $firstHouseId;
        $alumni->final_house_id = $finalHouseId;

        $alumni->date_of_birth = $this->parseDate($row[10] ?? '');
        $alumni->country = trim($row[11] ?? '');
        $alumni->state = trim($row[12] ?? '');
        $alumni->state_of_origin = trim($row[13] ?? '');
        $alumni->lga_of_origin = trim($row[14] ?? '');
        $alumni->address = trim($row[15] ?? '');

        $alumni->current_job = trim($row[16] ?? '');
        $alumni->expertise = trim($row[17] ?? '');
        $alumni->company_name = trim($row[18] ?? '');
        $alumni->company_designation = trim($row[19] ?? '');
        $alumni->work_address = trim($row[20] ?? '');
        $alumni->bio = trim($row[21] ?? '');

        $alumni->save();

        $this->info("Row {$rowIndex}: Imported - {$name} ({$email}) [password: {$password}]");
        return true;
    }

    private function findClassId(string $className): ?int
    {
        if (empty($className))
            return null;

        // Try exact match first
        if (isset($this->classes[$className])) {
            return $this->classes[$className];
        }

        // Try partial match (e.g., "JSS 1" might match "JSS1")
        $normalized = strtoupper(preg_replace('/\s+/', '', $className));
        foreach ($this->classes as $name => $id) {
            $normalizedName = strtoupper(preg_replace('/\s+/', '', $name));
            if ($normalizedName === $normalized || str_contains($normalizedName, $normalized)) {
                return $id;
            }
        }

        return null;
    }

    private function findHouseId(string $houseName): ?int
    {
        if (empty($houseName))
            return null;

        // Try exact match first
        if (isset($this->houses[$houseName])) {
            return $this->houses[$houseName];
        }

        // Try partial match
        $normalized = strtolower(trim($houseName));
        foreach ($this->houses as $name => $id) {
            if (str_contains(strtolower($name), $normalized) || str_contains($normalized, strtolower($name))) {
                return $id;
            }
        }

        return null;
    }

    private function parseDate($dateString): ?string
    {
        if (empty($dateString))
            return null;
        try {
            return \Carbon\Carbon::parse($dateString)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }

    private function downloadAndSaveImage(User $user, string $imageUrl): void
    {
        try {
            $contents = @file_get_contents($imageUrl);
            if ($contents) {
                // Determine extension and filename
                $extension = pathinfo(parse_url($imageUrl, PHP_URL_PATH), PATHINFO_EXTENSION);
                $extension = $extension ?: 'jpg';
                if (strlen($extension) > 4)
                    $extension = 'jpg';

                $fileName = 'user_' . $user->id . '_' . uniqid() . '.' . $extension;
                $path = 'users/' . $fileName; // Relative for Storage::disk('public')->put()
                $dbPath = 'uploads/' . $path; // Path stored in FileManager

                // Save file to storage
                Storage::disk('public')->put($path, $contents);

                // Get file details
                $size = strlen($contents);
                $mimeType = 'image/' . ($extension == 'jpg' ? 'jpeg' : $extension); // Basic mime guess

                // Create FileManager record
                $fileManager = new \App\Models\FileManager();
                $fileManager->tenant_id = 1; // Default Tenant
                $fileManager->file_type = $mimeType;
                $fileManager->storage_type = 'public'; // Assuming public disk
                $fileManager->original_name = basename(parse_url($imageUrl, PHP_URL_PATH));
                $fileManager->file_name = $fileName;
                $fileManager->user_id = $user->id;
                $fileManager->path = $dbPath; // Store full relative path including uploads/ prefix if that's convention
                $fileManager->extension = $extension;
                $fileManager->size = $size;
                $fileManager->external_link = $imageUrl; // Optional: store source
                $fileManager->save();

                // Link to User
                $user->image = $fileManager->id;
                $user->save();

                $this->info("  -> Downloaded profile image (ID: {$fileManager->id})");
            }
        } catch (\Exception $e) {
            $this->warn("  -> Failed to download image: " . $e->getMessage());
        }
    }
}
