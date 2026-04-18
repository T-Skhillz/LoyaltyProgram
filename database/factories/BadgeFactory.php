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
        return fake()->randomElement([
            [
                'name' => 'First Purchase',
                'points_required' => 10,
            ],
            [
                'name' => 'Big Spender',
                'points_required' => 500,
            ],
            [
                'name' => 'Loyal Customer',
                'points_required' => 1000,
            ],
            [
                'name' => '100 Points',
                'points_required' => 100,
            ],
            [
                'name' => '500 Points',
                'points_required' => 500,
            ],
            [
                'name' => 'Elite Member',
                'points_required' => 2000,
            ],
        ]);
    }
}
