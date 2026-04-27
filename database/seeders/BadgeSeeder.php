<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Badge;

class BadgeSeeder extends Seeder
{
    public function run(): void
    {
        $badges = [
            [
                'name'            => 'New Member',
                'points_required' => 0,
            ],
            [
                'name'            => 'Bronze',
                'points_required' => 50,
            ],
            [
                'name'            => 'Silver',
                'points_required' => 150,
            ],
            [
                'name'            => 'Gold',
                'points_required' => 350,
            ],
            [
                'name'            => 'Platinum',
                'points_required' => 700,
            ],
            [
                'name'            => 'Diamond',
                'points_required' => 1200,
            ],
        ];

        foreach ($badges as $badge) {
            Badge::firstOrCreate(
                ['name' => $badge['name']],
                $badge
            );
        }
    }
}