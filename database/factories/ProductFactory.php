<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->word(),
            'price' => rand(1000, 3444),
            'quantity' => rand(3, 100),
            'publish' => true,
            'user_id' => rand(1, 10),
            'description' => fake()->text(),
            'slug' => Str::slug(fake()->title())
        ];
    }
}
