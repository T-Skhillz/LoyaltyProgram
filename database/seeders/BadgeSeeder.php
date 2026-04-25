<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Badge;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Badge::factory()
            ->count(6)
            ->sequence(
                ['name' => 'Newcomer',      'points_required' => 0],
                ['name' => 'First Purchase', 'points_required' => 10],
                ['name' => 'Frequent Flyer', 'points_required' => 100],
                ['name' => 'Big Spender',    'points_required' => 500],
                ['name' => 'Loyal Customer', 'points_required' => 1000],
                ['name' => 'Elite Member',   'points_required' => 2000],
            )
            ->create();
    }
}
