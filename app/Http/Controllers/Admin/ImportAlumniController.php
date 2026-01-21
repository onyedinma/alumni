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
            'Bio'
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
                'I love coding.'
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
        $classes = SchoolClass::pluck('id', 'name')->toArray(); // ['JSS1 A' => 1, ...]
        $houses = House::pluck('id', 'name')->toArray();       // ['Red House' => 1, ...]

        $handle = fopen($path, 'r');
        $headers = fgetcsv($handle); // Skip headers

        // Validate headers roughly? Skip for now, assume template.

        $successCount = 0;
        $skippedCount = 0;
        $errors = [];

        DB::beginTransaction();

        try {
            while (($row = fgetcsv($handle)) !== false) {
                // simple mapping based on index from Sample
                // 0:Name, 1:Email, 2:Phone, 3:Nick, etc.

                $email = trim($row[1] ?? '');

                if (empty($email) || User::where('email', $email)->exists()) {
                    $skippedCount++;
                    continue;
                }

                $name = trim($row[0] ?? '');
                $mobile = trim($row[2] ?? '');

                if (empty($name)) {
                    $skippedCount++;
                    continue;
                }

                // Create User
                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'mobile' => $mobile,
                    'nick_name' => trim($row[3] ?? ''),
                    'password' => Hash::make('12345678'), // Default Password
                    'role' => USER_ROLE_ALUMNI,
                    'email_verified_at' => now(), // Auto verify?
                    'status' => STATUS_ACTIVE,
                ]);

                // Map Classes/Houses
                $firstClassName = trim($row[4] ?? '');
                $finalClassName = trim($row[5] ?? '');
                $firstHouseName = trim($row[6] ?? '');
                $finalHouseName = trim($row[7] ?? '');

                $firstClassId = $classes[$firstClassName] ?? null;
                $finalClassId = $classes[$finalClassName] ?? null;
                $firstHouseId = $houses[$firstHouseName] ?? null;
                $finalHouseId = $houses[$finalHouseName] ?? null;

                // Create Alumni logic
                $alumni = new Alumni();
                $alumni->user_id = $user->id;
                $alumni->first_class_id = $firstClassId;
                $alumni->final_class_id = $finalClassId;
                $alumni->first_house_id = $firstHouseId;
                $alumni->final_house_id = $finalHouseId;

                $alumni->date_of_birth = $this->parseDate($row[8] ?? '');
                $alumni->state = trim($row[9] ?? '');
                $alumni->country = trim($row[10] ?? '');
                $alumni->state_of_origin = trim($row[11] ?? '');
                $alumni->lga_of_origin = trim($row[12] ?? '');

                $alumni->current_job = trim($row[13] ?? '');
                $alumni->expertise = trim($row[14] ?? '');
                $alumni->company_name = trim($row[15] ?? '');
                $alumni->work_address = trim($row[16] ?? '');
                $alumni->bio = trim($row[17] ?? '');

                $alumni->save();

                $successCount++;
            }

            DB::commit();
            fclose($handle);

            return redirect()->back()->with('success', "Imported {$successCount} records successfully. Skipped {$skippedCount} (duplicates or invalid).");

        } catch (\Exception $e) {
            DB::rollBack();
            fclose($handle);
            return redirect()->back()->with('error', 'Import failed: ' . $e->getMessage());
        }
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
}
