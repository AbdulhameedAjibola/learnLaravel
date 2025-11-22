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
        'amount',
        'payment_date',
        'status',
        'outstanding_balance'
    ];

    public function loans(): BelongsTo{
        return $this->belongsTo(Loan::class);
    }

  
}
