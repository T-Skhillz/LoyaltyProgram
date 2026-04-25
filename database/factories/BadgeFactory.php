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
            'name' => $this->faker->word(),
            'points_required' => $this->faker->numberBetween(0, 5000),
        ];
    }
}
