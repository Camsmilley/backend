<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class GuideSeeder extends Seeder
{
    public function run()
    {
        DB::table('guides')->insert([
            [
                'name' => 'John Doe',
                'gender' => 'Male',
                'phone' => '1234567890',
                'email' => 'john@example.com',
                'role' => 'Tour Guide',
                'image' => 'default.png'
            ],
            // Add more sample guides as needed
        ]);
    }
}
