<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;

class AlumniIdService
{
    /**
     * Generate a unique alumni ID number
     */
    public function generateAlumniIdNumber(User $user): string
    {
        // Format: ALU-YEAR-XXXXX (e.g., ALU-2007-00123)
        $year = $user->alumni?->passing_year ?? date('Y');

        // Get the next sequential number
        $lastNumber = User::whereNotNull('alumni_id_number')
            ->where('alumni_id_number', 'like', "ALU-{$year}-%")
            ->count();

        $nextNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);

        return "ALU-{$year}-{$nextNumber}";
    }

    /**
     * Generate or get alumni ID number for a user
     */
    public function ensureAlumniId(User $user): string
    {
        if ($user->alumni_id_number) {
            return $user->alumni_id_number;
        }

        $idNumber = $this->generateAlumniIdNumber($user);

        $user->update([
            'alumni_id_number' => $idNumber,
        ]);

        return $idNumber;
    }

    /**
     * Generate ID card for user
     */
    public function generateIdCard(User $user): array
    {
        // Ensure user has an alumni ID
        $this->ensureAlumniId($user);

        // Mark as generated
        $user->update([
            'id_card_generated_at' => now(),
        ]);

        return [
            'alumni_id' => $user->alumni_id_number,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->alumni?->mobile ?? '',
            'graduation_year' => $user->alumni?->passing_year ?? '',
            'house' => $user->alumni?->house?->name ?? '',
            'class' => $user->alumni?->schoolClass?->name ?? '',
            'photo' => $user->image ? getFileUrl($user->image) : null,
            'qr_url' => route('alumni.id.verify', $user->alumni_id_number),
            'generated_at' => now()->format('M d, Y'),
        ];
    }

    /**
     * Get verification URL for alumni ID
     */
    public function getVerificationUrl(string $alumniId): string
    {
        return route('alumni.id.verify', $alumniId);
    }

    /**
     * Verify an alumni ID exists
     */
    public function verifyAlumniId(string $alumniId): ?User
    {
        return User::where('alumni_id_number', $alumniId)
            ->where('status', STATUS_ACTIVE)
            ->first();
    }
}
