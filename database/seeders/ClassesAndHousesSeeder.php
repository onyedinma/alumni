<?php

namespace Database\Seeders;

use App\Models\House;
use App\Models\SchoolClass;
use Illuminate\Database\Seeder;

class ClassesAndHousesSeeder extends Seeder
{
    public function run(): void
    {
        // FGCO Houses
        $houses = [
            'Red House',
            'Blue House',
            'Green House',
            'Yellow House',
            'Purple House',
        ];

        foreach ($houses as $house) {
            House::firstOrCreate(['name' => $house]);
        }

        // FGCO Classes - JSS1 A through JSS3 J, SS1 A through SS3 J
        $levels = ['JSS1', 'JSS2', 'JSS3', 'SS1', 'SS2', 'SS3'];
        $arms = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];

        foreach ($levels as $level) {
            foreach ($arms as $arm) {
                SchoolClass::firstOrCreate(['name' => $level . ' ' . $arm]);
            }
        }

        $this->command->info('Classes and Houses seeded successfully!');
    }
}
