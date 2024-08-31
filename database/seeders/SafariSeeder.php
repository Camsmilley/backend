<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SafariSeeder extends Seeder
{
    public function run()
    {
        $safaris = [
            [
                'title' => 'Mount Pulag Trek',
                'min_guests' => 20,
                'time_estimate' => '5hr 9m',
                'price' => 1000,
                'location'=>'Mount Pulag',
                'image' => 'pulag.jpg',
                'description' => 'Experience the breathtaking beauty of Mount Pulag, the highest peak in Luzon.',
                'inclusions' => "- All entrance and exit fees\n- Camping equipment\n- Guide fees\n- 3 meals per day\n- Transportation from Baguio City",
                'exclusions' => "- Personal expenses\n- Travel insurance\n- Tips for guides",
                'additional_info' => 'This trek is available for joiners from all over the Philippines. A good level of fitness is required.',
            ],
            [
                'title' => 'Mount Apo',
                'min_guests' => 25,
                'time_estimate' => '3days',
                'price' => 1300,
                'location'=>'Mount Apo',
                'image' => 'mountapo.png',
                'description' => 'Explore the ancient Banaue Rice Terraces, often called the "Eighth Wonder of the World".',
                'inclusions' => "- Guided tour of the terraces\n- Traditional Ifugao lunch\n- Jeepney ride to viewpoints\n- Entrance fees",
                'exclusions' => "- Accommodation\n- Transportation to and from Banaue\n- Personal expenses",
                'additional_info' => 'This tour is suitable for all ages. Wear comfortable walking shoes.',
            ],
            [
                'title' => 'Mount Ulap',
                'min_guests' => 20,
                'time_estimate' => '3h 31m',
                'price' => 8999,
                'location'=>'Mount Ulap',
                'image' => 'mtulap.jpg',
                'description' => 'All roads lead to Mt. Apo.. Lets conquer the higest mountain in the philippines archipelago',
                'inclusions' => "- All entrance and exit\n- Lake Venado camping feedback\n- Roundtrip transfer\n- Personalized bag tag \n 6 hosted meal\n Guide fees\n Group logistics",
                'exclusions' => "- Flights\n- Hotel accommodation before and after hike\n- Personal expenses",
                'additional_info' => 'This adventure tour combines natural wonders with exciting activities. Suitable for families and adventure seekers.',
            ],
            [
                'title' => 'Mount Pinatubo',
                'min_guests' => 30,
                'time_estimate' => '4h 1m',
                'price' => 1600,
                'location'=>'Mount Pinatubo',
                'image' => 'mtpinatubo.webp',
                'description' => 'Mount Pinatubo is an active stratovolcano in the Zambales Mountains in Luzon island of the Philippines.',
                'inclusions' => "- All entrance and exit\n- Roundtrip transfer\n- Personalized bag tag \n -2 hosted meal\n -Guide fees\n -Group logistics",
                'exclusions' => "- Flights\n- Hotel accommodation\n- Personal expenses",
                'additional_info' => 'This adventure tour combines natural wonders with exciting activities. Suitable for families and adventure seekers.',
            ],
            [
                'title' => 'Mount Batulao',
                'min_guests' => 30,
                'time_estimate' => '4h',
                'price' => 1600,
                'location'=>'Mount Batulao',
                'image' => 'mtbalutao.webp',
                'description' => 'Mt. Batulao is located in Nasugbu, Batangas. Known for its easy trails and beautiful landscape, it is considered as one of the must-climb mountains in the country. 
                There are 2 trails to choose from, the Old Trail and the New Trail.',
                'inclusions' => "- All entrance and exit\n- Roundtrip transfer\n- Personalized bag tag \n -2 hosted meal\n -Guide fees\n -Group logistics",
                'exclusions' => "- Flights to and from Bohol\n- Hotel accommodation\n- Personal expenses",
                'additional_info' => 'This adventure tour combines natural wonders with exciting activities. Suitable for families and adventure seekers.',
            ],
            [
                'title' => 'Mount Maculot',
                'min_guests' => 30,
                'time_estimate' => '4h',
                'price' => 1200,
                'location'=>'Mount Maculot',
                'image' => 'mtmaculot.jpg',
                'description' => 'A popular hiking option in Batangas, the climb up Mount Maculot, is for beginner to moderate climbers.
                 You have to reach Cuenca by foot or bicycle to reach the jump-off point from where the trail actually begins. The hiking
                 trail has three stops – the Rockies, the summit, and the Grotto.',
                'inclusions' => "- All entrance and exit\n- Roundtrip transfer\n- Personalized bag tag \n -2 hosted meal\n -Guide fees\n -Group logistics",
                'exclusions' => "- Flights\n- Hotel accommodation\n- Personal expenses",
                'additional_info' => 'This adventure tour combines natural wonders with exciting activities. Suitable for families and adventure seekers.',
            ],
        ];

        foreach ($safaris as $safari) {
            DB::table('safaris')->insert($safari);
        }
    }
}