<?php

namespace Database\Factories;

use App\Models\Achievement;
use Illuminate\Database\Eloquent\Factories\Factory;

class AchievementFactory extends Factory
{
    protected $model = Achievement::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->words(2, true),
            'type' => $this->faker->randomElement(['purchases_count', 'amount_spent']),
            'points_awarded' => $this->faker->numberBetween(10, 500),
            'threshold' => $this->faker->numberBetween(1, 1000),
        ];
    }

    // Purchase-based states
    public function purchaseType(): static
    {
        return $this->state(fn () => ['type' => 'purchases_count']);
    }

    // Spending-based states
    public function spendingType(): static
    {
        return $this->state(fn () => ['type' => 'amount_spent']);
    }

    // Specific Tier States
    public function whale(): static
    {
        return $this->state(fn () => [
            'name' => 'Whale',
            'type' => 'amount_spent',
            'points_awarded' => 1000,
            'threshold' => 25000,
        ]);
    }
}

// namespace Database\Factories;

// use App\Models\Achievement;
// use Illuminate\Database\Eloquent\Factories\Factory;

// /**
//  * @extends Factory<Achievement>
//  */
// class AchievementFactory extends Factory
// {
//     /**
//      * Define the model's default state.
//      *
//      * @return array<string, mixed>
//      */
//     public function definition(): array
//     {
//         // Provide a safe "fallback" default
//         return [
//             'name' => 'Achievement',
//             'type' => 'purchases_count',
//             'points_awarded' => 10,
//             'threshold' => 1,
//         ];
//     }

//     // Create specific states for your tiers
//     public function platinum(): static
//     {
//         return $this->state(fn (array $attributes) => [
//             'name' => 'VIP',
//             'points_awarded' => 1000,
//             'threshold' => 150,
//             'type' => 'purchases_count',
//         ]);
//     }

//     public function silver(): static
//     {
//         return $this->state(fn (array $attributes) => [
//             'name' => 'Bronze Spender',
//             'points_awarded' => 50,
//             'threshold' => 10,
//             'type' => 'purchases_count',
//         ]);
//     }
    
// }
