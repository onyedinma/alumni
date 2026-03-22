<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\House;
use App\Models\SchoolClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\Log;

class ImportAlumniController extends Controller
{
    public function index()
    {
        $title = 'Import Alumni';
        return view('admin.alumni.import', compact('title'));
    }

    public function downloadSample()
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="alumni_import_sample.csv"',
        ];

        $columns = [
            'Full Name',
            'Email',
            'Phone',
            'Nick Name',
            'First Year Class',
            'Final Year Class',
            'First House',
            'Final House',
            'Date of Birth',
            'State of Residence',
            'Country of Residence',
            'State of Origin',
            'LGA of Origin',
            'Current Job',
            'Expertise',
            'Company Name',
            'Work Address',
            'Bio',
            'Image URL'
        ];

        $callback = function () use ($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            // Add a sample row
            fputcsv($file, [
                'John Doe',
                'john@example.com',
                '1234567890',
                'Johnny',
                'JSS1 A',
                'SS3 A',
                'Red House',
                'Green House',
                '1990-01-01',
                'Lagos',
                'Nigeria',
                'Anambra',
                'Onitsha North',
                'Software Engineer',
                'Web Development',
                'Tech Corp',
                '123 Tech St',
                'I love coding.',
                'https://example.com/profile.jpg'
            ]);

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('file');
        $path = $file->getRealPath();

        // Cache mappings
        $classes = SchoolClass::pluck('id', 'name')->toArray();
        $houses = House::pluck('id', 'name')->toArray();

        $handle = fopen($path, 'r');
        $headers = fgetcsv($handle);

        // Build column index map from headers
        $columnMap = $this->buildColumnMap($headers);

        $updateExisting = $request->boolean('update_existing');
        $successCount = 0;
        $updatedCount = 0;
        $skippedCount = 0;
        $errors = [];

        DB::beginTransaction();

        try {
            while (($row = fgetcsv($handle)) !== false) {
                // Get values using dynamic column mapping
                $email = trim($this->getColumnValue($row, $columnMap, 'email') ?? '');

                if (empty($email)) {
                    $skippedCount++;
                    continue;
                }

                $existingUser = User::where('email', $email)->first();

                // Skip if user exists and we're not updating
                if ($existingUser && !$updateExisting) {
                    $skippedCount++;
                    continue;
                }

                $name = trim($this->getColumnValue($row, $columnMap, 'name') ?? '');
                $mobile = trim($this->getColumnValue($row, $columnMap, 'phone') ?? '');

                if (empty($name)) {
                    $skippedCount++;
                    continue;
                }

                if ($existingUser) {
                    // Update existing user
                    $user = $existingUser;
                    $user->update([
                        'name' => $name,
                        'mobile' => $mobile ?: $user->mobile,
                        'nick_name' => trim($this->getColumnValue($row, $columnMap, 'nickname') ?? '') ?: $user->nick_name,
                    ]);
                    $isUpdate = true;
                } else {
                    // Create new user
                    $user = User::create([
                        'name' => $name,
                        'email' => $email,
                        'mobile' => $mobile,
                        'nick_name' => trim($this->getColumnValue($row, $columnMap, 'nickname') ?? ''),
                        'password' => Hash::make('12345678'),
                        'role' => USER_ROLE_ALUMNI,
                        'email_verified_at' => now(),
                        'status' => STATUS_ACTIVE,
                    ]);
                    $isUpdate = false;
                }

                // Handle Image Upload (only if user doesn't have one, or it's a new import)
                $imageUrl = trim($this->getColumnValue($row, $columnMap, 'image') ?? '');
                if (!empty($imageUrl) && (empty($user->image) || !$isUpdate)) {
                    try {
                        $downloadUrl = $this->convertGoogleDriveUrl($imageUrl);
                        $contents = @file_get_contents($downloadUrl);

                        if ($contents) {
                            $tempPath = sys_get_temp_dir() . '/alumni_import_' . uniqid() . '.jpg';
                            file_put_contents($tempPath, $contents);

                            $uploadedFile = new \Illuminate\Http\UploadedFile(
                                $tempPath,
                                'profile_' . $user->id . '.jpg',
                                'image/jpeg',
                                null,
                                true
                            );

                            $fileManager = new \App\Models\FileManager();
                            $uploaded = $fileManager->upload('users', $uploadedFile);

                            if ($uploaded) {
                                $user->image = $uploaded->id;
                                $user->save();
                            }

                            @unlink($tempPath);
                        }
                    } catch (\Exception $e) {
                        // Continue without image
                    }
                }

                // Map Classes/Houses with fuzzy matching
                $firstClassName = trim($this->getColumnValue($row, $columnMap, 'first_class') ?? '');
                $finalClassName = trim($this->getColumnValue($row, $columnMap, 'final_class') ?? '');
                $firstHouseName = trim($this->getColumnValue($row, $columnMap, 'first_house') ?? '');
                $finalHouseName = trim($this->getColumnValue($row, $columnMap, 'final_house') ?? '');

                $firstClassId = $this->matchClass($firstClassName, $classes);
                $finalClassId = $this->matchClass($finalClassName, $classes);
                $firstHouseId = $this->matchHouse($firstHouseName, $houses);
                $finalHouseId = $this->matchHouse($finalHouseName, $houses);

                // Create or Update Alumni record
                Alumni::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'first_class_id' => $firstClassId,
                        'final_class_id' => $finalClassId,
                        'first_house_id' => $firstHouseId,
                        'final_house_id' => $finalHouseId,
                        'date_of_birth' => $this->parseDate($this->getColumnValue($row, $columnMap, 'dob') ?? ''),
                        'state' => trim($this->getColumnValue($row, $columnMap, 'state_residence') ?? ''),
                        'country' => trim($this->getColumnValue($row, $columnMap, 'country') ?? ''),
                        'state_of_origin' => trim($this->getColumnValue($row, $columnMap, 'state_origin') ?? ''),
                        'lga_of_origin' => trim($this->getColumnValue($row, $columnMap, 'lga') ?? ''),
                        'current_job' => trim($this->getColumnValue($row, $columnMap, 'job') ?? ''),
                        'expertise' => trim($this->getColumnValue($row, $columnMap, 'expertise') ?? ''),
                        'company_name' => trim($this->getColumnValue($row, $columnMap, 'company') ?? ''),
                        'work_address' => trim($this->getColumnValue($row, $columnMap, 'work_address') ?? ''),
                        'bio' => trim($this->getColumnValue($row, $columnMap, 'bio') ?? ''),
                    ]
                );

                if ($isUpdate) {
                    $updatedCount++;
                } else {
                    $successCount++;
                }
            }

            DB::commit();
            fclose($handle);

            $message = "Imported {$successCount} new records";
            if ($updatedCount > 0) {
                $message .= ", updated {$updatedCount} existing records";
            }
            if ($skippedCount > 0) {
                $message .= ", skipped {$skippedCount}";
            }
            $message .= ".";

            return redirect()->back()->with('success', $message);

        } catch (\Exception $e) {
            DB::rollBack();
            fclose($handle);
            return redirect()->back()->with('error', 'Import failed: ' . $e->getMessage());
        }
    }

    /**
     * Build column map from CSV headers
     */
    private function buildColumnMap($headers)
    {
        $map = [];

        foreach ($headers as $index => $header) {
            $header = strtolower(trim($header));

            // Map various header names to standard keys
            if (str_contains($header, 'full name') || $header === 'name') {
                $map['name'] = $index;
            } elseif (str_contains($header, 'email')) {
                $map['email'] = $index;
            } elseif (str_contains($header, 'phone') || str_contains($header, 'mobile')) {
                $map['phone'] = $index;
            } elseif (str_contains($header, 'nick') || str_contains($header, 'alias')) {
                $map['nickname'] = $index;
            } elseif (str_contains($header, 'image') || str_contains($header, 'photo')) {
                $map['image'] = $index;
            } elseif (str_contains($header, 'first year class') || str_contains($header, 'first class')) {
                $map['first_class'] = $index;
            } elseif (str_contains($header, 'final year class') || str_contains($header, 'final class')) {
                $map['final_class'] = $index;
            } elseif (str_contains($header, 'first house')) {
                $map['first_house'] = $index;
            } elseif (str_contains($header, 'final house')) {
                $map['final_house'] = $index;
            } elseif (str_contains($header, 'birth') || $header === 'dob') {
                $map['dob'] = $index;
            } elseif (str_contains($header, 'country')) {
                $map['country'] = $index;
            } elseif (str_contains($header, 'state of residence') || $header === 'state of residence') {
                $map['state_residence'] = $index;
            } elseif (str_contains($header, 'state of origin')) {
                $map['state_origin'] = $index;
            } elseif (str_contains($header, 'lga')) {
                $map['lga'] = $index;
            } elseif (str_contains($header, 'job') || str_contains($header, 'business')) {
                $map['job'] = $index;
            } elseif (str_contains($header, 'expertise') || str_contains($header, 'field')) {
                $map['expertise'] = $index;
            } elseif (str_contains($header, 'company') || str_contains($header, 'business name')) {
                $map['company'] = $index;
            } elseif (str_contains($header, 'office') || str_contains($header, 'work address')) {
                $map['work_address'] = $index;
            } elseif (str_contains($header, 'portfolio') || str_contains($header, 'introduce') || $header === 'bio') {
                $map['bio'] = $index;
            }
        }

        return $map;
    }

    /**
     * Get column value by key from row using column map
     */
    private function getColumnValue($row, $columnMap, $key)
    {
        if (!isset($columnMap[$key])) {
            return null;
        }
        return $row[$columnMap[$key]] ?? null;
    }

    private function parseDate($dateString)
    {
        if (empty($dateString))
            return null;
        try {
            return \Carbon\Carbon::parse($dateString)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Convert Google Drive sharing URL to direct download URL
     * 
     * @param string $url
     * @return string
     */
    private function convertGoogleDriveUrl($url)
    {
        // Handle various Google Drive URL formats
        // Format 1: https://drive.google.com/open?id=FILE_ID
        // Format 2: https://drive.google.com/file/d/FILE_ID/view
        // Format 3: https://drive.google.com/uc?id=FILE_ID

        $fileId = null;

        // Extract file ID from URL
        if (preg_match('/[?&]id=([a-zA-Z0-9_-]+)/', $url, $matches)) {
            $fileId = $matches[1];
        } elseif (preg_match('/\/d\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            $fileId = $matches[1];
        }

        if ($fileId) {
            // Return direct download URL
            return 'https://drive.google.com/uc?export=download&id=' . $fileId;
        }

        // Return original URL if not a Google Drive link
        return $url;
    }

    /**
     * Fuzzy match class name to database class
     * Normalizes: "JSS1B" -> "JSS1 B", "jss 1 b" -> "JSS1 B"
     */
    private function matchClass($csvValue, $classes)
    {
        if (empty($csvValue))
            return null;

        // Direct match first
        if (isset($classes[$csvValue])) {
            return $classes[$csvValue];
        }

        // Normalize the input
        $normalized = $this->normalizeClassName($csvValue);

        // Try exact match on normalized
        if (isset($classes[$normalized])) {
            return $classes[$normalized];
        }

        // Try case-insensitive match
        foreach ($classes as $name => $id) {
            if (strtolower($name) === strtolower($normalized)) {
                return $id;
            }
        }

        return null;
    }

    /**
     * Normalize class name: "JSS1B" -> "JSS1 B", "jss 1 b" -> "JSS1 B"
     */
    private function normalizeClassName($name)
    {
        // Remove extra spaces and uppercase
        $name = strtoupper(preg_replace('/\s+/', '', $name));

        // Match pattern like JSS1A, SS3C, J1A, S3E
        if (preg_match('/^(JSS|SS|J|S)(\d)([A-J])?$/i', $name, $matches)) {
            $level = strtoupper($matches[1]);
            // Expand J to JSS, S to SS
            if ($level === 'J')
                $level = 'JSS';
            if ($level === 'S')
                $level = 'SS';

            $year = $matches[2];
            $arm = isset($matches[3]) ? strtoupper($matches[3]) : '';

            return $level . $year . ($arm ? ' ' . $arm : '');
        }

        return $name;
    }

    /**
     * Fuzzy match house name to database house
     * Normalizes: "red house" -> "Red House", "RED" -> "Red House"
     */
    private function matchHouse($csvValue, $houses)
    {
        if (empty($csvValue))
            return null;

        // Direct match first
        if (isset($houses[$csvValue])) {
            return $houses[$csvValue];
        }

        // Normalize to lowercase for comparison
        $csvLower = strtolower(trim($csvValue));

        // Map color shortcuts to full names
        $colorMap = [
            'red' => 'Red House',
            'blue' => 'Blue House',
            'green' => 'Green House',
            'yellow' => 'Yellow House',
            'purple' => 'Purple House',
        ];

        // Check if it's just a color
        foreach ($colorMap as $color => $fullName) {
            if (strpos($csvLower, $color) !== false) {
                if (isset($houses[$fullName])) {
                    return $houses[$fullName];
                }
            }
        }

        // Try case-insensitive partial match
        foreach ($houses as $name => $id) {
            if (
                strtolower($name) === $csvLower ||
                str_contains(strtolower($name), $csvLower) ||
                str_contains($csvLower, strtolower(str_replace(' House', '', $name)))
            ) {
                return $id;
            }
        }

        return null;
    }
}

