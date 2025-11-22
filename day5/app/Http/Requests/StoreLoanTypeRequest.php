<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoanTypeRequest extends FormRequest
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
            'name'=> ['required'],
            'duration'=> ['required'],
            'interestRate'=> ['required'],
            'maxAmount'=> ['required']
        ];
    }

    protected function prepareForValidation(){
        return $this->merge([
            
            'interestRate' => $this->interestRate,
            'maxAmount' => $this->maxAmount
        ]);
    }
}
