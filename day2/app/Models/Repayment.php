<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Loan;



class Repayment extends Model
{
    /** @use HasFactory<\Database\Factories\RepaymentFactory> */
    use HasFactory;

     protected $fillable = [
        'loan_id',
        'instalment_amount',
        
        'remaining_balance',
        'payment_date',
        'payment_status',
    ];

    // multiple repayments belong to one loan
    public function loan(): BelongsTo{
        return $this->belongsTo(Loan::class);
    }
    
    // repayment belong to one user through loans (can also be multiple repayments, but each repayment belongs to one user through loan)
    // this might be unnecessary, will clarify
    public function user(){
        return $this->loan->user();
    }
}
