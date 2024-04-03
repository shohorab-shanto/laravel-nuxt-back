<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'type' => $this->type,
            'nid' => $this->nid,
            'religion' => $this->religion,
            'gender' => $this->gender,
            'designation_id' => $this->designation_id,
            'division_id' => $this->division_id,
            'district_id' => $this->district_id,
            'upazila_id' => $this->upazila_id,
            'union_id' => $this->union_id,
            'ward_id' => $this->ward_id,
            'status' => $this->status,
            'designation' => $this->designation,
            'division' => $this->division,
            'district' => $this->district,
            'role' => $this->roles->pluck('name'),
            'role_id' => $this->roles->pluck('id'),
            'permissions' => $this->roles->flatMap(function ($role) {
                return $role->permissions->pluck('name');
            })
        ];
    }
}
