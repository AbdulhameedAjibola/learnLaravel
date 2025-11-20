<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Loan>
 */
class LoanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(['pending', 'approved', 'rejected']);

        return [
            'customer_id' => Customer::factory(),
            'amount' => $this->faker->numberBetween(1000, 10000),
            'status' => $status,
            'approved_at' => $status == 'approved' ? $this->faker->dateTime() : null,
            'rejected_at' => $status == 'rejected' ? $this->faker->dateTime() : null,
            'repayment_date' => $status == 'approved' ? $this->faker->dateTimeBetween('+1 month', '+1 year') : null,

        ];
    }
}
