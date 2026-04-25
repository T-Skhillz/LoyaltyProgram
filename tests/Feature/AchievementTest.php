<?php

use App\Models\User;
use App\Models\Achievement;
use App\Models\Badge;

it('gets and checks all 5 fields are correct', function () {
    // arrange - create a user and authenticate
    $user = User::factory()->create([
        'current_points' => 150, 
        'total_purchase_count' => 3, 
        'total_amount_spent' => 5000
    ]);    
    $this->actingAs($user);

    // Two achievements — one the user has unlocked, one they haven't:
    $unlocked_achievement = Achievement::factory()->platinum()->create();

    $available_achievement = Achievement::factory()->silver()->create([
        'type' => 'purchases_count',
        'threshold' => 200,
    ]);

    // Two Badges - one the user qualifies for and the next available badge
    $unlocked_badge = Badge::factory()->create(['points_required' => 100]);
    $next_badge = Badge::factory()->create(['points_required' => 300]);

    // attach the unlocked achievement to the user
    $user->achievements()->attach($unlocked_achievement->id, ['unlocked_at' => now()]);

     // act - GET /api/v1/users/{user}/achievements for all 5 fields:
        // ■ unlocked_achievements (array of strings)
        // ■ next_available_achievements (array of strings)
        // ■ current_badge (string)
        // ■ next_badge (string)
        // ■ remaining_to_unlock_next_badge (integer)
    $response = $this->getJson("/api/v1/users/{$user->id}/achievements");
    
    // assert - check that all 5 fields are consistent
    //dd(Achievement::all()->toArray(), $response->json());
    $response->assertStatus(200)
        ->assertJsonStructure([
                    'data' => [
                        'achievements' => ['unlocked_achievements', 'next_available_achievements'],
                        'badges' => ['current_badge', 'next_badge', 'remaining_to_unlock_next_badge']
                    ]
                ])
                ->assertJson([
                    'data' => [
                        'achievements' => [
                            'unlocked_achievements' => [
                                ['id' => $unlocked_achievement->id]
                            ],
                            'next_available_achievements' => [
                                ['id' => $available_achievement->id]
                            ],
                        ],
                        'badges' => [
                            'current_badge' => ['id' => $unlocked_badge->id],
                            'next_badge' => ['id' => $next_badge->id],
                            'remaining_to_unlock_next_badge' => 150, // 300 (next) - 150 (current)
                        ]
                    ]
                ]);    
});

