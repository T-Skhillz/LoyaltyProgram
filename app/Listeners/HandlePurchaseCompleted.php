<?php

namespace App\Listeners;

use App\Events\PurchaseCompleted;
use App\Services\PurchaseCompletedService;

class HandlePurchaseCompleted
{  
    /**
     * Create the event listener.
     */
    public function __construct(
        protected PurchaseCompletedService $purchaseCompletedService
    ){}

    /**
     * Handle the event.
     */
    public function handle(PurchaseCompleted $event): void
    {
        $this->purchaseCompletedService->handle($event);
    }
}
