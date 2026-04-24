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
        // Define logical tiers to ensure consistency
        $tiers = [
            'bronze' => [
                'names' => ['Early Bird', 'First Step', 'Newcomer'],
                'points' => 10,
                'spend' => 100,
                'count' => 1
            ],
            'silver' => [
                'names' => ['Regular', 'Bronze Spender', 'Loyal Supporter'],
                'points' => 50,
                'spend' => 1000,
                'count' => 10
            ],
            'gold' => [
                'names' => ['Big Spender', 'Power User', 'Elite Collector'],
                'points' => 250,
                'spend' => 5000,
                'count' => 50
            ],
            'platinum' => [
                'names' => ['Whale', 'Legendary Member', 'VIP'],
                'points' => 1000,
                'spend' => 25000,
                'count' => 150
            ]
        ];

        $selectedTier = fake()->randomElement($tiers);
        $type = fake()->randomElement(['amount_spent', 'purchases_count']);

        return [
            'name'           => fake()->randomElement($selectedTier['names']),
            'type'           => $type,
            'points_awarded' => $selectedTier['points'],
            'threshold'      => ($type === 'amount_spent') 
                                ? $selectedTier['spend'] 
                                : $selectedTier['count'],
        ];
    }
    
}
