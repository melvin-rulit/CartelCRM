<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RemainResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                   => $this->resource->id,
            'amount'               => $this->resource->amount,
            'createdAt'            => $this->resource->created_at->format('Y-m-d\TH:i'),
            'createdAtAsPrintable' => $this->resource->created_at->format('d.m.Y H:i'),
        ];
    }
}
