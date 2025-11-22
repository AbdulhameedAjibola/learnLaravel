<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\LoanType;
use App\Models\Repayment;



class Loan extends Model
{
    /** @use HasFactory<\Database\Factories\LoanFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'loan_type_id',
        'principal',
        'interest_rate',
        
        'start_date',
        'end_date',
        'status',

    ];

    public function users(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function loanTypes(): BelongsTo {
        return $this->belongsTo(LoanType::class);
    }

    public function repayments(): HasMany{
        return $this->hasMany(Repayment::class);
    }

    protected static function booted()
    {
        static::creating(function ($loan){
            $loan->total_amount = $loan->principal + ($loan->principal * ($loan->interest_rate / 100));

            $loan->is_due = now() ->gt($loan->end_date);
        });

        static::updating(function($loan){
            $loan->total_amount = $loan->principal + ($loan->principal * ($loan->interest_rate / 100));

            $loan->is_due = now()->gt($loan->end_date);
        });
    }
}
