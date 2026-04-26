<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    public function run(): void
    {
        $achievements = [
            ['name' => 'Early Bird',      'type' => 'purchases_count', 'points_awarded' => 10,   'threshold' => 1],
            ['name' => 'Regular',         'type' => 'purchases_count', 'points_awarded' => 50,   'threshold' => 10],
            ['name' => 'Power User',      'type' => 'purchases_count', 'points_awarded' => 250,  'threshold' => 50],
            ['name' => 'Loyal Supporter', 'type' => 'amount_spent',    'points_awarded' => 50,   'threshold' => 1000],
            ['name' => 'Whale',           'type' => 'amount_spent',    'points_awarded' => 1000, 'threshold' => 25000],
        ];

        foreach ($achievements as $data) {
            Achievement::updateOrCreate(['name' => $data['name']], $data);
        }
    }
}

// namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Database\Seeder;

// use App\Models\Achievement;

// class AchievementSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      */
//     public function run(): void
//     {
//         Achievement::factory()
//             ->count(5)
//             ->sequence(
//                 ['name' => 'Early Bird',     'type' => 'purchases_count', 'points_awarded' => 10,   'threshold' => 1],
//                 ['name' => 'Regular',        'type' => 'purchases_count', 'points_awarded' => 50,   'threshold' => 10],
//                 ['name' => 'Power User',     'type' => 'purchases_count', 'points_awarded' => 250,  'threshold' => 50],
//                 ['name' => 'Loyal Supporter','type' => 'amount_spent',    'points_awarded' => 50,   'threshold' => 1000],
//                 ['name' => 'Whale',          'type' => 'amount_spent',    'points_awarded' => 1000, 'threshold' => 25000],
//             )
//             ->create();
//     }
// }
