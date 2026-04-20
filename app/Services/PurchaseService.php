<?php

namespace App\Services;

use App\Models\User;
use App\Models\Purchase;
use App\Events\PurchaseCompleted;
use Illuminate\Support\Facades\DB;

class PurchaseService
{
    public function completePurchase(User $user, int $amount)
    {
        DB::transaction(function() use ($user, $amount){
            Purchase::create([
                'user_id' => $user->id,
                'amount' => $amount,
                'status' => 'completed'
            ]);

            $user->increment('total_amount_spent', $amount);
            $user->increment('total_purchase_count');

        });

        PurchaseCompleted::dispatch($user);
    }
}