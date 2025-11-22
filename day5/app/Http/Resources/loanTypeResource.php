<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class loanTypeResource extends JsonResource
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
            'name' => $this->name,
            'duration'=>$this->duration,
            'interestRate'=>$this->interest_rate,
            'maxAmount'=>$this->max_amount

        ];
        //return parent::toArray($request);
    }
}
