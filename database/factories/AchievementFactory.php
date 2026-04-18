<?php

namespace Database\Factories;

use App\Models\Achievement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Achievement>
 */
class AchievementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = fake()->randomElement(['amount_spent', 'purchases_count']);

        return [
            'name' => fake()->randomElement([
                'First Purchase',
                'Big Spender',
                'Loyal Customer',
                '100 Points',
                '500 Points',
                'Elite Member',
            ]),
            'type' => $type,
            'points_awarded' => fake()->randomElement([10, 50, 100, 250]),
            'threshold' => $type === 'amount_spent'
                ? fake()->randomElement([1000, 5000, 10000]) // money
                : fake()->randomElement([1, 5, 10, 20]),     // count
        ];
    }
    
}
