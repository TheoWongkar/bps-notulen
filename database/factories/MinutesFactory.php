<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Minutes>
 */
class MinutesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'followed_up_by' => User::inRandomOrder()->first()->id,
            'problem' => fake()->paragraph(),
            'solution' => fake()->paragraph(),
            'follow_up_plan' => fake()->sentence(),
            'follow_up_limits' => fake()->dateTimeBetween('+1 week', '+1 month')->format('Y-m-d'),
            'data_source' => fake()->company(),
            'evidence' => null,
        ];
    }
}
