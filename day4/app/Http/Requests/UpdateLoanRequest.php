<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLoanRequest extends FormRequest
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
          $method = $this->method(); 
        if ($method == 'PUT') {
            return [
                'customerId' => ['required', 'exists:customers,id'],
                'amount' => ['required', 'numeric', 'min:0.01'],
                'status' => ['required', 'in:pending,approved,rejected'],
                'approvedAt' => ['nullable', 'date'],
                'rejectedAt' => ['nullable', 'date'],
                'repaymentDate' => ['nullable', 'date']
            ];
        } else{
             return [
                'customerId' => ['sometimes', 'required', 'exists:customers,id'],
                'amount' => ['sometimes', 'required', 'numeric', 'min:0.01'],
                'status' => ['sometimes', 'required', 'in:pending,approved,rejected'],
                'approvedAt' => ['sometimes', 'nullable', 'date'],
                'rejectedAt' => ['sometimes', 'nullable', 'date'],
                'repaymentDate' => ['sometimes', 'nullable', 'date']
            ];
        }
    }

      protected function prepareForValidation(){
        return $this->merge([
            'customer_id' => $this->customerId,
            'approved_at' => $this->approvedAt,
            'rejected_at' => $this->rejectedAt,
            'repayment_date' => $this->repaymentDate
        ]);
    }
}
