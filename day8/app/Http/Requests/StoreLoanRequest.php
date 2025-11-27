<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'principal' => 'required|numeric|min:0',
            'interest_rate' => 'required|numeric|min:0',
            'duration' => 'required|integer',
            'duration_type' => 'required|in:months,years',
            'loan_start_date' => 'required|date',
            'expected_end_date' => 'required|date|after:start_date',
            'status' => 'required|in:pending,approved,rejected,paid',
        ];
    }

     protected function prepareForValidation()
    {
        return $this->merge([
            'user_id' => $this->userId,
            'interest_rate' => $this->interestRate,
            'duration_type' => $this->durationType,
            'loan_start_date' => $this->loanStartDate,
            'end_date' => $this->expectedEndDate,
            'is_due' => $this->isDue


        ]);
    }
}
