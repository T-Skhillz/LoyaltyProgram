<?php

namespace App\Listeners;

use App\Events\BadgeUnlocked;
use App\Services\BadgeUnlockedService;

class HandleBadgeUnlocked
{
    /**
     * Create the event listener.
     */
    public function __construct(
        protected BadgeUnlockedService $badgeUnlockedService
    ) {}
    
    /**
     * Handle the event.
     */
    public function handle(BadgeUnlocked $event): void
    {
        $this->badgeUnlockedService->handle($event);
    }
}
