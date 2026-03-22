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
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportAlumniFromExcel extends Command
{
    protected $signature = 'alumni:import-excel {file : Path to the Excel file}';
    protected $description = 'Import alumni data from the FGCO Excel file';

    private $classes = [];
    private $houses = [];

    public function handle()
    {
        $filePath = $this->argument('file');

        if (!file_exists($filePath)) {
            $this->error("File not found: {$filePath}");
            return 1;
        }

        $this->info("Loading Excel file...");
        $spreadsheet = IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        // Cache mappings
        $this->classes = SchoolClass::pluck('id', 'name')->toArray();
        $this->houses = House::pluck('id', 'name')->toArray();

        $this->info("Found " . (count($rows) - 1) . " data rows.");

        $successCount = 0;
        $skippedCount = 0;

        DB::beginTransaction();

        try {
            foreach ($rows as $index => $row) {
                if ($index === 0)
                    continue; // Skip header row

                $result = $this->importRow($row, $index);
                if ($result) {
                    $successCount++;
                } else {
                    $skippedCount++;
                }
            }

            DB::commit();
            $this->info("Import complete! Success: {$successCount}, Skipped: {$skippedCount}");
            return 0;

        } catch (\Exception $e) {
            DB::rollBack();
            $this->error("Import failed: " . $e->getMessage());
            return 1;
        }
    }

    private function importRow(array $row, int $rowIndex): bool
    {
        // Column mapping based on Excel structure:
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
        $alumni->designation = trim($row[19] ?? '');
        $alumni->work_address = trim($row[20] ?? '');
        $alumni->bio = trim($row[21] ?? '');

        $alumni->save();

        $this->info("Row {$rowIndex}: Imported - {$name} ({$email})");
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
                $extension = pathinfo(parse_url($imageUrl, PHP_URL_PATH), PATHINFO_EXTENSION);
                $extension = $extension ?: 'jpg';
                if (strlen($extension) > 4)
                    $extension = 'jpg';

                $fileName = 'user_' . $user->id . '_' . uniqid() . '.' . $extension;
                Storage::disk('public')->put('users/' . $fileName, $contents);
                $user->image = $fileName;
                $user->save();
            }
        } catch (\Exception $e) {
            // Silently continue without image
        }
    }
}
