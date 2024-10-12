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
            'name' => $this->resource->getFullName(),
            'firstName' => $this->resource->first_name,
            'middleName' => $this->resource->middle_name,
            'lastName' => $this->resource->last_name,
            'phone' => $this->resource->phone,
            'city' => $this->resource->city,
            'telegram_login' => $this->resource->telegram_login,
        ];
    }
}
