<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Badge;
use App\Models\Cashback;

class CashbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $badges = Badge::all();

        foreach ($users as $user) {
            $earnedBadges = $user->badges; // or however you track this

            foreach ($earnedBadges as $badge) {
                Cashback::firstOrCreate(
                    [
                        'user_id' => $user->id,
                        'badge_id' => $badge->id,
                    ],
                    [
                        'amount' => 300.00,
                        'created_at' => now(),
                    ]
                );
            }
        }
    }

}
