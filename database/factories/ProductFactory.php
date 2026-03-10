<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(12),
            'price' => $this->faker->randomFloat(2, 10, 2000),
            'image' => 'product-' . $this->faker->unique()->numberBetween(1, 50) . '.jpg',
        ];
    }
}
