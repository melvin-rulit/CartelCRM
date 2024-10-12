<?php

namespace App\Http\Resources;

use App\Models\User;
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
        return [
            'id'                  => $this->resource->id,
            'name'                => $this->resource->getFullName(),
            'firstName'           => $this->resource->first_name,
            'middleName'          => $this->resource->middle_name,
            'lastName'            => $this->resource->last_name,
            'birthday'            => $this->resource->birthday?->format('Y-m-d'),
//            'passportSeries'      => $this->resource->passport_series,
//            'passportNumber'      => $this->resource->passport_number,
//            'passportNotes'       => $this->resource->passport_notes,
//            'registrationAddress' => $this->resource->registration_address,
//            'phoneNumber'         => $this->resource->phone_number,
//            'comment'             => $this->resource->comment,
            'email'               => $this->resource->email,
//            'roleId'              => $this->resource->role_id,
//            'branchId'            => $this->resource->branch_id,
//            'branch'              => BranchResource::make($this->resource->branch),
//            'role'                => User::getRoleName($this->resource->role_id),
            'enabled'             => $this->resource->enabled,
        ];
    }
}
