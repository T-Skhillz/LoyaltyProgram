<?php

namespace App\Services;

use App\Models\User;
use App\Models\Cashback;
use App\Models\Badge;

class BadgeUnlockedService
{
    public function handle($event)
    {
        $user = $event->user;
        $badge = $event->badge;

        $cashback = Cashback::firstOrCreate(
            ['user_id' => $user->id, 'badge_id' => $badge->id],
            ['amount' => 300, 'created_at' => now()]
        );
    }
}