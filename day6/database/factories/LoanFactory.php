<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

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
        $loan_type = ['Mortgage', 'Personal', 'Airtime', 'Car Loan'];
        $status = $this->faker->randomElement(['pending', 'approved', 'rejected', 'paid']);
        $startDate = $this->faker->dateTimeBetween('-1 month', 'now');
        $endDate = $this->faker->dateTimeBetween('-6 months', '+1 month');
        $isDue = $status === 'approved' && now() > $endDate ? true : false;

        return [
            'user_id' => User::factory(),
            'loan_type' => $this->faker->randomElement($loan_type),
            'principal' => $this->faker->randomFloat(2, 100000, 1000000),
            'interest_rate' => $this->faker->randomFloat(2, 1, 10),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'status' => $status,
            'is_due' => $isDue,
        ];
    }

    
}
