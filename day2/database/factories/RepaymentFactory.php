<?php

namespace Database\Factories;
use \App\Models\Loan;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Repayment>
 */
class RepaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       

        return [
            
            'instalment_amount' => $this->faker->randomFloat(2, 100, 5000),
            'remaining_balance' => $this->faker->randomFloat(2, 0, 20000),
            'payment_date' => $this->faker->date(),
            'payment_status' => $this->faker->randomElement(['paid', 'processing', 'failed']),
        ];
    }
}
