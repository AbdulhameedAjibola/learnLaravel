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
       
        return[
            'id' => $this->id,
            'customerId' =>$this->customer_id,
            'amount' => $this->amount,
            'status' => $this->status,
            'approvedAt' => $this->approved_at,
            'rejectedAt' => $this->rejected_at,
            'repaymentDate' => $this->repayment_date,
        ];
       
        // return parent::toArray($request);
    }
}
