<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add reunion countdown settings
        $settings = [
            ['option_key' => 'reunion_countdown_enabled', 'option_value' => '0'],
            ['option_key' => 'reunion_date', 'option_value' => ''],
            ['option_key' => 'reunion_title', 'option_value' => 'Annual Alumni Reunion'],
            ['option_key' => 'reunion_location', 'option_value' => ''],
        ];

        foreach ($settings as $setting) {
            // Only insert if not exists
            $exists = DB::table('settings')
                ->where('option_key', $setting['option_key'])
                ->exists();

            if (!$exists) {
                DB::table('settings')->insert($setting);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('settings')
            ->whereIn('option_key', [
                'reunion_countdown_enabled',
                'reunion_date',
                'reunion_title',
                'reunion_location',
            ])
            ->delete();
    }
};
