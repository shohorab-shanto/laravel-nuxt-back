<?php

namespace App\Http\Resources\TwinPitSelectedBeneficiary;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SelectedBeneficiaryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'le_name' => $this->user->name,
            'beneficiary_name' => $this->beneficiary->name,
            'status' => $this->status->title,
            'is_approved' => $this->is_approved,
            'otp_verified' => $this->otp_verified,
            'created_by' => $this->createdBy->name,
        ];
    }
}
