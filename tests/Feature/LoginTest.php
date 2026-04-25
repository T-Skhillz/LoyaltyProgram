<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('user can login with correct credentials', function () {
    // 1. Arrange: Create a user
    $user = User::factory()->create([
        'password' => Hash::make('password'),
    ]);

    // 2. Act: Hit the login endpoint
    $response = $this->postJson('/api/v1/login', [
        'username' => $user->username,
        'password' => 'password',
    ]);

    // 3. Assert: Check status and token
    $response->assertStatus(200)
             ->assertJsonStructure(['access_token']);
    
    // Grab the token from the response
    $token = $response->json('access_token');

    // ACTUALLY authenticate the next request with that token
    $this->withHeader('Authorization', 'Bearer ' . $token)
         ->getJson('/api/v1/user') // Or any protected route
         ->assertStatus(200)
         ->assertJsonPath('username', $user->username);
});

test('user cannot login with incorrect password', function () {
    $user = User::factory()->create();

    $response = $this->postJson('/api/v1/login', [
        'username' => $user->username,
        'password' => 'wrong-password',
    ]);

    $response->assertStatus(401);
    $this->assertGuest();
});


