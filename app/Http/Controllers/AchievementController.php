<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexAchievementRequest;
use App\Services\AchievementArrayService;
use App\Models\User;
use App\Http\Resources\AchievementResource;
use Illuminate\Support\Facades\Auth;

class AchievementController extends Controller
{
    public function __construct(protected AchievementArrayService $achievementArrayService){}

    public function index(IndexAchievementRequest $request, User $user): AchievementResource {
        $user = Auth::user(); 
        $data = $this->achievementArrayService->handle($user);

        return new AchievementResource($data);
    }
}
