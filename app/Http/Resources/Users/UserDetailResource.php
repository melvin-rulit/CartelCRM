<?php

namespace App\Http\Resources\Users;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'full_name' => $this->resource->getFullName(),
            'first_name' => $this->resource->first_name,
            'middle_name' => $this->resource->middle_name,
            'last_name' => $this->resource->last_name,
            'birthday' => $this->resource->birthday?->format('d-m-Y'),
            'email' => $this->resource->email,
            'passport_series' => $this->resource->passport_series,
            'passport_give' => $this->resource->passport_give,
            'passport_number' => $this->resource->passport_number,
            'passport_issuedBy' => $this->resource->passport_issuedBy,
            'passport_issuedByDate' => $this->resource->passport_issuedByDate,
            'registration_address' => $this->resource->registration_address,
            'live_adress' => $this->resource->live_adress,
            'phone_number' => $this->resource->phone_number,
            'telegram' => $this->resource->telegram,
            'password_see' => $this->resource->password_see,
            'role' => User::getRoleName($this->resource->id),
        ];
    }
}
