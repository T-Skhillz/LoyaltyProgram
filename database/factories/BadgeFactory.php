<?php

namespace Database\Factories;

use App\Models\Purchase;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Purchase>
 */
class BadgeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(2, true), // Generates "Golden Star", etc.
            'points_required' => fake()->unique()->numberBetween(10, 5000),
        ];
    }
}
