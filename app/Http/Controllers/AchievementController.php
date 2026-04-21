<?php

namespace App\Http\Controllers;
use App\Http\Requests\IndexAchievementRequest;
use App\Services\AchievementArrayService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class AchievementController extends Controller
{
    public function __construct(protected AchievementArrayService $achievementArrayService){}

    public function index(IndexAchievementRequest $request, User $user): JsonResponse {
        $user = Auth::user(); 
        $this->achievementArrayService->handle($user);

        return response()->json($data);
    }
}
