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

    // multiple repayments belong to one loan
    public function loanRepayment(): BelongsTo{
        return $this->belongsTo(Loan::class);
    }
    
    // repayment belong to one user through loans (can also be multiple repayments, but each repayment belongs to one user through loan)
    // this might be unnecessary, will clarify
    public function userRepayments(){
        return $this->loan->user();
    }
}
