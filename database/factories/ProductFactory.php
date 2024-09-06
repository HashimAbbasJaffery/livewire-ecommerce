<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
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
            "title" => fake()->jobTitle(),
            "price" => fake()->numberBetween(0, 200),
            "new_price" => !rand(0, 1) ? fake()->numberBetween(0, 200) : null,
            "description" =>  fake()->paragraph(),
            "quantity" => fake()->numberBetween(0, 10),
            "status" => rand(0, 1),
            "extra_description" => "<p>It is amazing scarf.... You must buy it</p><ul><li>Database</li><li>Migration</li></ul>"
        ];
    }
}
