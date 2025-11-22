<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Loan;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Repayment>
 */
class RepaymentFactory extends Factory
{
    
    public function definition(): array
    {
        return [
            'loan_id' => Loan::factory(),
            'amount' => $this->faker->numberBetween(1000, 10000),
            'payment_date' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'status' => $this->faker->randomElement(['pending', 'completed', 'failed']),
            'outstanding_balance' => $this->faker->numberBetween(0, 12000)
        ];
    }
}
