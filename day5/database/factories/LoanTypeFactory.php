<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LoanType>
 */
class LoanTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'duration' => $this->faker->numberBetween(6, 60),
            'interest_rate' => $this->faker->randomFloat(2, 5, 10),
            'max_amount' => $this->faker->numberBetween(50000, 500000),
        ];
    }
}
