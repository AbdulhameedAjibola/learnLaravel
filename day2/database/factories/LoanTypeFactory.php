<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\LoanType;


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
            'loan_name' => $this->faker->word(),
            'duration' => $this->faker->randomElement(['6 months', '12 months', '24 months', '36 months']),
            'interest_rate' => $this->faker->randomFloat(2, 1, 9), 
            'max_amount' => $this->faker->numberBetween(1000, 500000)
        ];
    }
}
