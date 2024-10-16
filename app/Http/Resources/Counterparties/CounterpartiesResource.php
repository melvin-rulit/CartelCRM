<?php

namespace App\Http\Resources\Counterparties;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CounterpartiesResource extends JsonResource
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
            'firstName' => $this->resource->first_name,
            'middleName' => $this->resource->middle_name,
            'lastName' => $this->resource->last_name,
            'phone' => $this->resource->phone,
            'city' => $this->resource->city,
            'telegram_login' => $this->resource->telegram_login,
        ];
    }
}
