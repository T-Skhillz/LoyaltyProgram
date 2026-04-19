<?php

namespace App\Services;

use App\Models\User;
use App\Models\Achievement;
use App\Models\Badge;
use App\Events\BadgeUnlocked;

class AchievementUnlockedService
{
    public function handle($event)
    {
        $user = $event->user;
        $achievement = $event->achievement;

        // 1. Perform the atomic increment
        $user->increment('current_points', $achievement->points_awarded);
        
        // 2. Refresh the model to get the updated points from the DB
        $user->refresh();

        // 3. Fetch the next available Badge
        $badge = Badge::where('points_required', '<=', $user->current_points)
                    ->orderBy('points_required', 'desc')->first();

        $alreadyOwned = $user->badges()->where('badge_id', $badge->id)->exists();

        if(!$alreadyOwned) {
            // 4. Create a record in the user_badge table
            $user->badges()->attach($badge->id, ['unlocked_at' => now()]);

            // 5. Fire the BadgeUnlocked event
            BadgeUnlocked::dispatch($user, $badge);
        }
    }
}