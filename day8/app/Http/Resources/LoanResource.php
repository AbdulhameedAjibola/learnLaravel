<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       return [
        "id"=> $this->id,
        "userId" => $this->user_id,
        "principal" =>$this->principal,
        "interestRate" => $this->interest_rate,
        "totalAmount" => $this->total_amount,
        "duration" => $this->duration,
        "durationType" => $this->duration_type,
        "loanStartDate" => $this->loan_start_date,
        "expectedEndDate" => $this->expected_end_date,
        "status"=>$this->status,
        "isDue" => $this->is_due
           ];
    }
}
