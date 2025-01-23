<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Food>
 */
class FoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word,
            'protein' => fake()->randomFloat(1, 0, 50),
            'carbs' => fake()->randomFloat(1, 0, 100),
            'fat' => fake()->randomFloat(1, 0, 50),
            'grams' => fake()->randomFloat(1, 0, 500),
        ];
    }
}
