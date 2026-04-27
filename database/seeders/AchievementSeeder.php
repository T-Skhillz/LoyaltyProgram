<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Achievement;

class AchievementSeeder extends Seeder
{
    public function run(): void
    {
        $achievements = [
            // Purchase count milestones
            [
                'name'           => 'First Order',
                'type'           => 'purchases_count',
                'threshold'      => 1,
                'points_awarded' => 10,
            ],
            [
                'name'           => 'Regular Shopper',
                'type'           => 'purchases_count',
                'threshold'      => 5,
                'points_awarded' => 30,
            ],
            [
                'name'           => 'Frequent Buyer',
                'type'           => 'purchases_count',
                'threshold'      => 10,
                'points_awarded' => 75,
            ],
            [
                'name'           => 'Power Shopper',
                'type'           => 'purchases_count',
                'threshold'      => 25,
                'points_awarded' => 150,
            ],
            [
                'name'           => 'Elite Customer',
                'type'           => 'purchases_count',
                'threshold'      => 50,
                'points_awarded' => 300,
            ],

            // Amount spent milestones (in Naira)
            [
                'name'           => 'First Spend',
                'type'           => 'amount_spent',
                'threshold'      => 1000,
                'points_awarded' => 10,
            ],
            [
                'name'           => 'Bronze Spender',
                'type'           => 'amount_spent',
                'threshold'      => 5000,
                'points_awarded' => 40,
            ],
            [
                'name'           => 'Silver Spender',
                'type'           => 'amount_spent',
                'threshold'      => 20000,
                'points_awarded' => 100,
            ],
            [
                'name'           => 'Gold Spender',
                'type'           => 'amount_spent',
                'threshold'      => 50000,
                'points_awarded' => 250,
            ],
            [
                'name'           => 'Whale',
                'type'           => 'amount_spent',
                'threshold'      => 100000,
                'points_awarded' => 600,
            ],
        ];

        foreach ($achievements as $achievement) {
            Achievement::firstOrCreate(
                ['name' => $achievement['name']],
                $achievement
            );
        }
    }
}