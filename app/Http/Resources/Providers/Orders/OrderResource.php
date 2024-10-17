<?php

namespace App\Http\Resources\Providers\Orders;

use App\Http\Resources\Providers\ProvidersResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'order_number' => $this->resource->order_number,
            'order_date' => Carbon::create($this->resource->order_date)->format('d-m-Y'),
            'status' => $this->resource->status,
            'provider' => ProvidersResource::make($this->resource->provider),
            'order_details' => $this->resource->order_details,
            'order_price' => $this->resource->order_price,
        ];
    }
}
