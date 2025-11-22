<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\LoanType;

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
   public function definition(): array {
    $principal = $this->faker->randomFloat(2, 1000, 10000);
    $interestRate = $this->faker->randomFloat(2, 1, 15);
    $totalAmount = $principal + ($principal * $interestRate / 100);

    $status = $this->faker->randomElement(['pending', 'approved', 'rejected', 'paid']);
    $startDate = $this->faker->dateTimeBetween('-1 month', 'now');
    $endDate = $this->faker->dateTimeBetween('+1 month', '+1 year');
    $isDue = $status === 'approved' && now() > $endDate ? $this->faker->boolean() : false;

    return [
        'user_id' => User::factory(),
        'loan_type_id' => LoanType::factory(),
        'principal' => $principal,
        'interest_rate' => $interestRate,
        'total_amount' => $totalAmount,
        'start_date' => $startDate,
        'end_date' => $endDate,
        'status' => $status,
        'is_due' => $isDue,
    ];
}

}
