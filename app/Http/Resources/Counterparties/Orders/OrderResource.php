<?php

namespace App\Http\Resources\Counterparties\Orders;

use Carbon\Carbon;
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
//            'id' => $this->resource->id,
//            'counterpart' => CounterpartiesResource::make($this->resource->counterpart),
//            'order_number' => $this->resource->order_number,
//            'order_date' => $this->resource->order_date,
//            'status' => $this->resource->status,
//            'order_details' => $this->resource->order_details,
//            'order_price' => $this->resource->order_price,
//            'delivery_address' => $this->resource->delivery_address,

            'id' => $this->resource->id,
            'is_paid' => $this->resource->is_paid,
            'order_number' => $this->resource->order_number,
            'order_date' => Carbon::create($this->resource->order_date)->format('d-m-Y'),
            'order_date_in_store' => Carbon::create($this->resource->order_date_in_store)->format('d-m-Y'),
//            'status' => OrderStatusEnum::labels()[$this->resource->status] ?? $this->resource->status,
//            'provider' => ProvidersResource::make($this->resource->provider),
            'order_details' => $this->resource->order_details,
            'order_price' => $this->resource->order_price,
//            'manager' => UserResource::make($this->resource->manager),
//            'order_sostavs' => $this->resource->sostavs,
        ];
    }
}
