<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\AchievementController;

// Group everything under V1
Route::prefix('v1')->group(function () {
    
    // Public Auth
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    // Protected Routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', fn (Request $request) => $request->user());
        Route::post('/logout', [AuthController::class, 'logout']);

        Route::post('/purchases', [PurchaseController::class, 'store'])->name('purchase.store');
        Route::get('/users/{user}/achievements', [AchievementController::class, 'index'])->name('achievement.index');
    });
});