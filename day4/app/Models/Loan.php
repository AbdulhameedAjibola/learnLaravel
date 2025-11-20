<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Loan extends Model
{
    /** @use HasFactory<\Database\Factories\LoanFactory> */
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'amount',
        'status',
        'approved_at',
        'rejected_at',
        'repayment_date'
    ];

    public function customer(): BelongsTo{
        return $this->belongsTo(Customer::class);
    }
}
