<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LoanPractice>
 */
class LoanPracticeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => $this->faker->numberBetween(1000,10000),
            'status' => $this->faker->randomElement(['paid', 'due', 'overdue', 'pending']),
            'user-name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),

        ];
    }
}
