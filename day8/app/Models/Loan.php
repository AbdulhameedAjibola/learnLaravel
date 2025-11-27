<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Loan extends Model
{
    /** @use HasFactory<\Database\Factories\LoanFactory> */
    use HasFactory;




    protected $fillable = [
        'user_id',
        'principal',
        'interest_rate',
        'total_amount',
        'duration',
        'duration_type',
        
        'loan_start_date',
        'expected_end_date',

        'status',
        "is_due"


    ];

 /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_due' => 'boolean',
        'loan_start_date' => 'date',
        'expected_end_date' => 'date',
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }



    protected static function booted()
    {
        
        static::creating(function ($loan) {
            $loan->total_amount = $loan->principal + ($loan->principal * ($loan->interest_rate / 100));
            
            
            $loan->is_due = $loan->expected_end_date && now()->gt($loan->expected_end_date);
        });

        
        static::updating(function ($loan) {
            
            if ($loan->isDirty(['principal', 'interest_rate'])) {
                $loan->total_amount = $loan->principal + ($loan->principal * ($loan->interest_rate / 100));
            }
            
            
            $loan->is_due = $loan->expected_end_date && now()->gt($loan->expected_end_date);
        });
    }
}
