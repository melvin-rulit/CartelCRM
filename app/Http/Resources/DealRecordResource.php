<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DealRecordResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->resource->id,
            'amount'      => $this->resource->amount,
            'operationId' => $this->resource->operation_id,
            'createdAt'   => $this->resource->created_at->format('Y-m-d H:i'),
            'operation'   => OperationResource::make($this->resource->operation()->first())
        ];
    }
}
