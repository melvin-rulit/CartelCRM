<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientAmountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->resource->id,
            'clientId'  => $this->resource->client_id,
            'amount'    => $this->resource->amount,
            'createdAt' => $this->resource->created_at->format('Y-m-d\TH:i'),
        ];
    }
}
