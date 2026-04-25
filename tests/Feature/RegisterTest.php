<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('a user can register successfully', function () {
    // 1. Act: Hit the registration endpoint
    $response = $this->postJson('/api/v1/register', [
        'full_name' => 'John Snow',
        'username' => 'john',
        'email' => 'john@email.com',
        'password' => 'securePassword123',
        'password_confirmation' => 'securePassword123',
    ]);

    // 2. Assert: Response is correct
    $response->assertStatus(201) // 201 Created is standard for registration
             ->assertJsonStructure([
                'user' => ['id', 'username', 'email'],
                'access_token',
                'token_type'
             ]);

    // 3. Assert: Database has the user
    $this->assertDatabaseHas('users', [
        'username' => 'john',
        'email' => 'john@email.com',
    ]);

    // 4. Assert: Password is encrypted
    $user = User::where('username', 'john')->first();
    expect(Hash::check('securePassword123', $user->password))->toBeTrue();
});

test('registration fails if email is already taken', function () {
    // Arrange: Create an existing user
    User::factory()->create(['email' => 'duplicate@oau.edu.ng']);

    // Act
    $response = $this->postJson('/api/v1/register', [
        'full_name' => 'New User',
        'username' => 'newuser',
        'email' => 'duplicate@oau.edu.ng',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    // Assert
    $response->assertStatus(422)
             ->assertJsonValidationErrors(['email']);
});
