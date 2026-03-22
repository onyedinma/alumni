<?php

namespace Database\Seeders;

use App\Models\HistoryTimeline;
use Illuminate\Database\Seeder;

class HistoryTimelineSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing entries
        HistoryTimeline::truncate();

        $tenantId = getTenantId();

        $entries = [
            [
                'year' => 'May 17, 2017',
                'title' => 'The Genesis',
                'description' => 'The journey officially began when the late Ms. Ihuoma Ella, alongside three other pioneering members, created the WhatsApp group that would eventually grow into the vibrant alumni community we have today. The vision was simple but powerful: unity, support, and lifelong brotherhood and sisterhood.',
                'sort_order' => 1,
            ],
            [
                'year' => '2017',
                'title' => 'First Major Milestone',
                'description' => 'From the beginning, the group was casual and inclusive. The first major milestone was the collective support for our brother Nnamdi Njasi. The overwhelming response solidified trust and demonstrated the collective strength of the alumni. It was a moment that proved this was more than just a chat group — it was a family.',
                'sort_order' => 2,
            ],
            [
                'year' => '2017 – 2018',
                'title' => 'A Platform for Solidarity',
                'description' => 'A defining moment came during the illness of Paul Arisa. Information shared with the group became a catalyst for rapid growth, drawing in many alumni who had been out of touch and creating a platform for more consistent engagement. The group rallied together, reinforcing the principle of being each other\'s keeper.',
                'sort_order' => 3,
            ],
            [
                'year' => '2018',
                'title' => 'Excellence through Service',
                'description' => 'Leadership emerged naturally through service. Ms. Ihuoma Ella oversaw accounting, documentation, and reports, ensuring transparency in every initiative. Her meticulous dedication set the standard for leadership within the group and inspired others to step up and contribute to the community.',
                'sort_order' => 4,
            ],
            [
                'year' => '2018 – 2019',
                'title' => 'The Caretaker Committee',
                'description' => 'As the group grew in size and ambition, a more structured approach to governance became necessary. Comr. Chijioke Felix Maduka was appointed Chairman of the Caretaker Committee and Reunion Chairman, tasked with steering the group toward formal organization while maintaining its core spirit of togetherness.',
                'sort_order' => 5,
            ],
            [
                'year' => '2019 – 2020',
                'title' => 'Democratic Transition',
                'description' => 'Transitioning into a democratically led association, Caleb was elected as President with Anita as Vice President in our first major elections. This milestone marked a significant step in the group\'s evolution — from an informal WhatsApp collective to a structured alumni organization with elected officers and defined roles.',
                'sort_order' => 6,
            ],
            [
                'year' => '2020 – 2022',
                'title' => 'Resilience during COVID-19',
                'description' => 'The global pandemic tested the group\'s resolve. Despite physical distancing, the alumni community grew closer. Virtual meetings, welfare check-ins, and financial support for members in need became the norm. The group proved that distance could not diminish the bonds forged in the halls of FGC Ohafia.',
                'sort_order' => 7,
            ],
            [
                'year' => '2022 – 2023',
                'title' => 'Giving Back to FGC Ohafia',
                'description' => 'With a shared love for their alma mater, the group organized charitable initiatives to support the school. Donations of learning materials, classroom renovations, and mentorship programs were launched to ensure the next generation of students would enjoy better opportunities than before.',
                'sort_order' => 8,
            ],
            [
                'year' => '2023 – Present',
                'title' => 'A Legacy in Motion',
                'description' => 'Today, the FGC Ohafia Class of 2007 Alumni Group stands as a beacon of unity and purpose. With a growing membership, ongoing charitable projects, and a digital platform connecting alumni around the world, the group continues to uphold the founding vision: unity, service, and a lifelong commitment to one another.',
                'sort_order' => 9,
            ],
        ];

        foreach ($entries as $entry) {
            HistoryTimeline::create(array_merge($entry, [
                'tenant_id' => $tenantId,
                'is_active' => true,
            ]));
        }

        $this->command->info('Created ' . count($entries) . ' history timeline entries.');
    }
}
