<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use App\Services\AchievementUnlockedService;

class HandleAchievementUnlocked
{
    /**
     * Create the event listener.
     */
    public function __construct(
        protected AchievementUnlockedService $achievementUnlockedService
    ){}

    /**
     * Handle the event.
     */
    public function handle(AchievementUnlocked $event): void
    {
        $this->achievementUnlockedService->handle($event);
    }
}
