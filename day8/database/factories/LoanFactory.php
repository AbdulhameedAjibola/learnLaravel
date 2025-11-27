<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Carbon\Carbon;


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
          
        $principal = $this->faker->randomFloat(2, 1000, 50000);
        $interestRate = $this->faker->randomFloat(2, 5, 20); // 5.00% to 20.00%
        $duration = $this->faker->numberBetween(12, 60); // 1 to 5 years (in months)

        $durationType = $this->faker->randomElement(['months', 'years']);

        
        $interestFraction = $interestRate / 100;
        $totalAmount = $principal + ($principal * $interestFraction);
        
        
        $loanStartDate = $this->faker->dateTimeBetween('-1 year', 'now');
        $expectedEndDate = Carbon::parse($loanStartDate)->addMonths($duration);
        
        
        $status = $this->faker->randomElement(['pending', 'approved', 'paid']);
        
        
        if ($status === 'paid' && $expectedEndDate->isFuture()) {
            $status = 'approved';
        }

        return [
            
            'principal' => $principal,
            'interest_rate' => $interestRate,
            'total_amount' => $totalAmount,             
            'duration' => $duration,
            'duration_type' => $durationType,
            
            'loan_start_date' => $loanStartDate->format('Y-m-d'),
            'expected_end_date' => $expectedEndDate->format('Y-m-d'),

            'status' => $status,
            
        ];
    }
}
