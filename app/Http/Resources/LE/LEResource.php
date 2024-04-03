<?php

namespace App\Http\Resources\LE;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LEResource extends JsonResource
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
            'phone' => $this->phone,
            'nid' => $this->nid,
            'religion' => $this->religion,
            'gender' => $this->gender,
            'division' => $this->division,
            'district' => $this->district,
            'upazila' => $this->upazila,
            'union' => $this->union,
            'status' => $this->status,
        ];
    }
}
