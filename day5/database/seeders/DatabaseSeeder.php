<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Loan;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //  User::factory()->count(50)->hasLoans(3)->hasRepayments(5)->create();

        //  User::factory()->count(50)->hasLoans(3)->hasRepayments(5)->create();

        //  User::factory()->count(50)->hasLoans(3)->hasRepayments(5)->create();

         User::factory()->count(50)->has(
            Loan::factory()
            ->count(3)
            ->hasRepayments(5))
            ->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
