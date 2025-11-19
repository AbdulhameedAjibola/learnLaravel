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
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'loan_type_id' => LoanType::factory(),
            'principal' => $this->faker->randomFloat(2, 1000, 50000),
            'interest_rate' => $this->faker->randomFloat(2, 1, 10),
            'total_amount' => function (array $attributes) {
                return $attributes['principal'] + ($attributes['principal'] * $attributes['interest_rate'] / 100);
            },
            'duration_months' => $this->faker->randomElement([6, 12, 24, 36]),
            'monthly_installment' => function (array $attributes) {
                return $attributes['total_amount'] / $attributes['duration_months'];
            },
            'outstanding_balance' => function (array $attributes) {
                return $attributes['total_amount'];
            },
            'start_date' => $this->faker->date(),
            'end_date' => function (array $attributes) {
                return date('Y-m-d', strtotime($attributes['start_date']. ' + '.$attributes['duration_months'].' months'));
            },
        ];
    }
}
