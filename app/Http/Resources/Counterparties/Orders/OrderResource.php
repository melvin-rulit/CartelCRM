<?php

namespace App\Http\Resources\Counterparties\Orders;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Counterparties\CounterpartiesResource;

class OrderResource extends JsonResource
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
            'counterpart' => CounterpartiesResource::make($this->resource->counterparties),
            'order_number' => $this->resource->order_number,
            'order_date' => $this->resource->order_date,
            'status' => $this->resource->status,
            'order_details' => $this->resource->order_details,
            'order_price' => $this->resource->order_price,
            'delivery_address' => $this->resource->delivery_address,
        ];
    }
}
