<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLoanTypeRequest extends FormRequest
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
        if($method == 'PUT'){
            return [
                 'name'=> ['required'],
                'duration'=> ['required'],
                'interestRate'=> ['required'],
                'maxAmount'=> ['required']
            ];
        }else{
            return [
                'name'=> ['sometimes', 'required'],
                'duration'=> ['sometimes', 'required'],
                'interestRate'=> ['sometimes', 'required'],
                'maxAmount'=> ['sometimes', 'required']
            ];
        }
        
    }

    protected function prepareForValidation(){
        return $this->merge([
             'interestRate' => $this->interestRate,
            'maxAmount' => $this->maxAmount
        ]);
    }
}
