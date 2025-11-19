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
        'loan_type_id',
        'principal',
        'interest_rate',
        'total_amount',
        'duration_months',
        'monthly_installment',
        'outstanding_balance',
        'start_date',
        'end_date',
    ];

    // loan belong to one user (user can have multiple loans but they still belong to one user)

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
    
    // multiple loans belong to one loan type
    public function loan_type():BelongsTo{
        return $this->belongsTo(LoanType::class);
    }

    // multiple repayments belong to one loan// each loan can have multiple repayments
    public function repayments(): HasMany{
        return $this->hasMany(Repayment::class);
    }

    

}
