<?php

namespace App\Http\Resources;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->resource->id,
            'date'          => $this->resource->created_at->format('Y-m-d'),
            'datePrintable' => $this->resource->created_at->format('d.m.Y'),
            'rent'          => $this->resource->rent,
            'buyout'        => $this->resource->buyout
        ];
    }
}
