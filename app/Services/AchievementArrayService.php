<?php

namespace App\Services;

use App\Models\User;
use App\Models\Achievement;
use App\Models\Badge;

class AchievementArrayService
{
    public function fetchUnlockedAchievements(User $user){
        $unlockedAchievements = Achievement::whereHas('users', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->get();

        return $unlockedAchievements;
    }

    public function fetchNextAvailableAchievements(User $user){
        $AvailableAchievements = Achievement::whereIn('type', ['amount_spent', 'purchases_count'])
            ->whereDoesntHave('users', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->get()
            ->sortBy(function ($achievement) use ($user) {
                // Get the relevant user stat
                $current = ($achievement->type === 'purchases_count') 
                    ? $user->total_purchase_count 
                    : $user->total_amount_spent;

                // Return the gap (The smaller the gap, the higher it sits in the list)
                return $achievement->threshold - $current;
            });

         return $AvailableAchievements;
    }

    public function handle(User $user): array {
        $currentBadge = Badge::where('points_required', '<=', $user->current_points)
            ->orderBy('points_required', 'desc')->first();
        
        $nextBadge = Badge::where('points_required', '>', $user->current_points)
            ->orderBy('points_required', 'asc')->first();

        return [
            'unlocked_achievements' => $this->fetchUnlockedAchievements($user),
            'next_available_achievements' => $this->fetchNextAvailableAchievements($user),
            'current_badge' => $currentBadge,
            'next_badge' => $nextBadge,
            'remaining_to_unlock_next_badge' => $nextBadge 
                ? $nextBadge->points_required - $user->current_points 
                : null,
        ];
    }
}