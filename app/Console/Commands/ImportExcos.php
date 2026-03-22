<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Exco;
use App\Models\ExcoTenor;
use Illuminate\Support\Facades\File;

class ImportExcos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'excos:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import initial excos from the downloads folder.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting Exco Import...');

        // Create Tenor
        $tenor = ExcoTenor::withoutGlobalScopes()->firstOrCreate(
            ['title' => '2025 - 2028 Executives', 'tenant_id' => 1],
            [
                'start_date' => '2025-08-16',
                'is_current' => true
            ]
        );
        $this->info('Created/Found Tenor: ' . $tenor->title);

        $sourceFolder = 'C:\\Users\\onyed\\Downloads\\FGC EXCOS';
        $destFolder = public_path('uploads/excos');

        // Create destination if it doesn't exist
        if (!File::exists($destFolder)) {
            File::makeDirectory($destFolder, 0755, true);
        }

        $excosData = [
            [
                'name' => 'Kelechukwu Uzoka',
                'position' => 'President',
                'photo_file' => 'Kelechukwu Uzoka.jpeg',
                'bio' => "A lawyer, thought leader, social and policy shaper. I'm here to build a strong alumni and institutionalised leadership and service.",
                'order' => 1
            ],
            [
                'name' => 'Emenuga Miracle Ikechukwu',
                'position' => 'Vice President',
                'photo_file' => 'Emenuga Miracle Ikechukwu.jpeg',
                'bio' => "A Food technologist cum Educationist....Diligent and Purpose driven. My mandate is to aid the President in ensuring Top-Notch leadership and taking the alumni to enviable heights.",
                'order' => 2
            ],
            [
                'name' => 'ONYEADI ONYEYIRICHUKWU JACHIMIKE',
                'position' => 'Alumni Secretary',
                'photo_file' => 'ONYEADI ONYEYIRICHUKWU JACHIMIKE.jpeg',
                'bio' => "My mandate as Alumni Secretary is to ensure order, transparency, and continuity in our association. Through accurate documentation, timely communication, and structured record-keeping, I will strengthen our administrative system and preserve the legacy of our great institution.",
                'order' => 3
            ],
            [
                'name' => 'OKWUCHUKWU CHUKWUKA PETER',
                'position' => 'Assistant Secretary',
                'photo_file' => 'OKWUCHUKWU CHUKWUKA PETER.jpeg',
                'bio' => "My mandate as Assistant Secretary is to ensure order, transparency, and continuity in our association while maintaining a support system to the alumni secretary general. Through accurate documentation, timely communication, and structured record-keeping, I will also effectively enhance our administrative system and preserve the legacy of our great institution.",
                'order' => 4
            ],
            [
                'name' => 'mercy kalu',
                'position' => 'Treasurer',
                'photo_file' => 'mercy kalu.jpeg',
                'bio' => "My name is mercy kalu,I am a trader Nd I'm the treasurer of this alumni,i am in charge of organising Nd managing accounting and overseeing cash flow.alsoprovide financial guidance for the growth of the alumni.",
                'order' => 5
            ],
            [
                'name' => 'Chimerucheya Success Okeke',
                'position' => 'Financial Secretary',
                'photo_file' => 'Chimerucheya Success Okeke.jpeg',
                'bio' => "My parents named me Chimerucheya Success Okeke but fondly called Suscute/Sucky. I am the financial secretary. My mandate is to keep and give accurate financial reports and encourage any means of financial income and support. Above all, a transparent accounting to all the members.",
                'order' => 6
            ],
            [
                'name' => 'Chinahuzo John Nwaneri (Tablet)',
                'position' => 'Welfare / Social Director',
                'photo_file' => 'Chinahuzo John Nwaneri.jpeg',
                'bio' => "Our alumni network is more than a connection , it is a family. My mandate is simple: strengthen our unity, prioritize member welfare, and create engaging social platforms that keep us connected across all sets and locations. I am committed to building a supportive, responsive, and vibrant alumni community where every member feels valued. Together, we grow. Together, we stand.",
                'order' => 7
            ],
            [
                'name' => 'Onwuka Amarachi Asher',
                'position' => 'Public Relation Officer',
                'photo_file' => 'Onwuka Amarachi Asher.jpeg',
                'bio' => "Managing and representing the association’s public image by handling official communications, sharing updates, promoting activities, and serving as the link between the association, members, and the public/media",
                'order' => 8
            ],
            [
                'name' => 'Comr Maduka Chijioke',
                'position' => 'Provost',
                'photo_file' => 'Comr Maduka Chijioke.jpeg',
                'bio' => "My name is Comr Maduka Chijioke and I am honored to serve as your Provost. My mission is simple; to promote unity, discipline, accountability, and progress within our association. As Provost, my mandate is to ensure order is maintained, meetings are well coordinated, and our rules are respected while fostering mutual respect among members. Leadership is not about control, but about service — and I am committed to serving with integrity, fairness, and transparency. Together, we can build a stronger, more organized, and impactful association. Thank you.",
                'order' => 9
            ]
        ];

        foreach ($excosData as $data) {
            $photoPath = null;
            if ($data['photo_file']) {
                $sourcePath = $sourceFolder . '\\' . $data['photo_file'];
                $fileName = time() . '_' . str_replace([' ', '/', '\\'], '_', $data['photo_file']);
                $destPath = $destFolder . '/' . $fileName;

                if (File::exists($sourcePath)) {
                    File::copy($sourcePath, $destPath);
                    $photoPath = 'uploads/excos/' . $fileName;
                } else {
                    $this->warn("Photo not found at: {$sourcePath}");
                }
            }

            Exco::withoutGlobalScopes()->firstOrCreate(
                ['name' => $data['name'], 'exco_tenor_id' => $tenor->id, 'tenant_id' => 1],
                [
                    'position' => $data['position'],
                    'bio' => $data['bio'],
                    'photo' => $photoPath,
                    'order' => $data['order'],
                    'status' => 1
                ]
            );

            $this->info("Imported: {$data['name']}");
        }

        $this->info('Excos import completed successfully!');
    }
}
