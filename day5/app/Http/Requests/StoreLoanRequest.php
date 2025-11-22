<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;


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
            'loan_type_id' => 'required|exists:loan_types,id',
            'principal' => 'required|numeric|min:0',
            'interest_rate' => 'required|numeric|min:0',
            
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:pending,approved,rejected,paid',
        ];
    }

    protected function prepareForValidation()
    {
        return $this->merge([
            'user_id' => $this->userId,
            'loan_type_id' => $this->loanTypeId,
            'interest_rate' => $this->interestRate,
            
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
        


        ]);
    }
}
