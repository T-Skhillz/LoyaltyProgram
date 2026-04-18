<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Badge;

class UserBadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create();
        $badges = Badge::factory()->count(5)->create();

        foreach ($badges as $badge) {
            $user->badges()->attach($badge->id, [
                'unlocked_at' => now(),
            ]);
        }
    }
}
