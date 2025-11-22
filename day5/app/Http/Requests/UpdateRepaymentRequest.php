<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRepaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = $this->method();
        if($method == 'PUT'){
            
            return [
                'loan_id'=> ['required', 'exists:loans,id'],
                'amount' => ['required', 'numeric', 'min:100'],
                'paymentDate' => ['required', 'date'],
                'status' => ['required', 'in:pending, completed, failed'],
                'outstandingBalance' => ['required', 'numeric', 'min:0']
            ];

        }else{
            return[
                'loan_id'=> ['sometimes', 'required', 'exists:loans,id'],
                'amount' => ['sometimes', 'required', 'numeric', 'min:100'],
                'paymentDate' => ['sometimes', 'required', 'date'],
                'status' => ['sometimes', 'required', 'in:pending, completed, failed'],
                'outstandingBalance' => ['sometimes', 'required', 'numeric', 'min:0']
            ];
        }

       
        
    }

     protected function prepareforValidation(){
        return $this->merge([
            'loan_id' => $this->loanId,
            'payment_date' => $this->paymentDate,
            'outstanding_balance' => $this->outstandingBalance
        ]);
    }
}
