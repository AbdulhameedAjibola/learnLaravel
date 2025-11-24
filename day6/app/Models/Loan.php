<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    /** @use HasFactory<\Database\Factories\LoanFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'loan_type',
        'principal',
        'interest_rate',
        'start_date',
        'end_date',
        'status',
    ];

    public function user(){
        return $this-> belongsTo(User::class);
    }


    protected static function booted(){
       
        static::creating(function ($loan) {
            $loan->total_amount = $loan->principal + ($loan->principal * ($loan->interest_rate /100));

            $loan->is_due = now()->gt($loan->end_date); 
        });

        static::updating(function($loan){
             $loan->total_amount = $loan->principal + ($loan->principal * ($loan->interest_rate / 100));

            $loan->is_due = now()->gt($loan->end_date);
        });
    }
}
