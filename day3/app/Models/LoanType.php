<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Loan;
use Illuminate\Database\Eloquent\Relations\HasMany;


class LoanType extends Model
{
    /** @use HasFactory<\Database\Factories\LoanTypeFactory> */
    use HasFactory;

    protected $fillable = [
        'loan_name',
        'duration',
        'interest_rate',
        'max_amount',

    ];

     // one loan type can be for multiple loans

    public function loans(): HasMany{
        return $this->hasMany(Loan::class);
    }
}
