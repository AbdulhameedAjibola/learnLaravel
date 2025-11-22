<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class repaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'loanId' => $this->loan_id,
            'amount' => $this->amount,
            'paymentDate' => $this->payment_date,
            'status' => $this->status,
            'outstandingBalance' => $this->outstanding_balance,
        ];
        
        //return parent::toArray($request);
    }
}
