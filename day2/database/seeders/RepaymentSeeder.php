<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Repayment;
use \App\Models\Loan;


class RepaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $loans = Loan::all();

        foreach($loans as $loan){
            Repayment::factory()->create([
                 'loan_id' => $loan->id,
            ]
               
            );
        };
        
    }
}
