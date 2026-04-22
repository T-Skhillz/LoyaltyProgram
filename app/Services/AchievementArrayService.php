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
        $AvailableAchievements = Achievement::whereIn('type', ['amount_spent', 'purchase_count'])
            ->whereDoesntHave('users', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->get()
            ->sortBy(function ($achievement) use ($user) {
                // Get the relevant user stat
                $current = ($achievement->type === 'purchase_count') 
                    ? $user->total_purchase_count 
                    : $user->total_amount_spent;

                // Return the gap (The smaller the gap, the higher it sits in the list)
                return $achievement->threshold - $current;
            });

         return $AvailableAchievements;
    }

    public function fetchUserCurrentBadge(User $user){
        $currentBadge = Badge::where('points_required', '<=', $user->current_points)
            ->orderBy('points_required', 'desc')->first();

        return $currentBadge; 
    }

    public function fetchNextBadge(User $user){
        $nextBadge = Badge::where('points_required', '>', $user->current_points)
            ->orderBy('points_required', 'asc')->first();

        return $nextBadge;
    }

    public function pointsToUnlockNextBadge(User $user){
        $nextBadge = Badge::where('points_required', '>', $user->current_points)
            ->orderBy('points_required', 'asc')->first();
        return $nextBadge ? $nextBadge->points_required - $user->current_points : null;
    }

    public function handle(User $user): array {
        return [
            'unlocked_achievements' => $this->fetchUnlockedAchievements($user),
            'next_available_achievements' => $this->fetchNextAvailableAchievements($user),
            'current_badge' => $this->fetchUserCurrentBadge($user),
            'next_badge' => $this->fetchNextBadge($user),
            'remaining_to_unlock_next_badge' => $this->pointsToUnlockNextBadge($user),
        ];
    }
}