<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SchoolIdentitySeeder extends Seeder
{
    /**
     * Seed school identity settings.
     */
    public function run(): void
    {
        $settings = [
            ['option_key' => 'school_motto', 'option_value' => ''],
            ['option_key' => 'school_anthem', 'option_value' => ''],
            ['option_key' => 'school_history', 'option_value' => ''],
            ['option_key' => 'school_founded_year', 'option_value' => ''],
            ['option_key' => 'school_crest', 'option_value' => ''],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['option_key' => $setting['option_key']],
                ['option_value' => $setting['option_value']]
            );
        }
    }
}
