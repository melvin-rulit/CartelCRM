<?php

namespace App\Http\Resources\Providers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProvidersResource extends JsonResource
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
            'full_name_with_contacts' => $this->resource->getFullNameWithContacts(),
            'first_name' => $this->resource->first_name,
            'middle_name' => $this->resource->middle_name,
            'last_name' => $this->resource->last_name,
            'phone' => $this->resource->phone,
            'city' => $this->resource->city,
            'telegram' => $this->resource->telegram,
        ];
    }
}
