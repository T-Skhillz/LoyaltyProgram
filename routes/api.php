<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\AchievementController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/v1/purchases', [PurchaseController::class, 'store'])->name('purchase.store');
    Route::get('/v1/users/{user}/achievements', [AchievementController::class, 'index'])->name('achievement.index');
});

// Route::apiResource(PurchaseController::class, 'store')