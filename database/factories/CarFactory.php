<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company . ' ' . $this->faker->word, // Generate a fake car name
            'model' => $this->faker->word, // Generate a fake car model
            'price' => $this->faker->randomFloat(2, 10000, 50000), // Random price between 10,000 and 50,000 with 2 decimal places
            'is_available' => $this->faker->boolean, // Random boolean value (true or false)
        ];
    }
}
