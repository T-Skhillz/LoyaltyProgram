<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Achievement;

class UserAcheivementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create();
        $achievements = Achievement::factory()->count(5)->create();

        foreach ($achievements as $achievement) {
            $user->achievements()->attach($achievement->id, [
                'unlocked_at' => now(),
            ]);
        }
    }
}
