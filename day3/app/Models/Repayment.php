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
        'instalment_amount',
        'remaining_balance',
        'payment_date',
        'payment_status',
    ];

    // multiple repayments belong to one loan
    public function loanRepayment(): BelongsTo{
        return $this->belongsTo(Loan::class);
    }
    
   
}
