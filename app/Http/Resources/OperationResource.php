<?php

namespace App\Http\Resources;

use App\Models\Operation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property Operation $resource */
class OperationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'     => $this->resource->id,
            'name'   => $this->resource->name,
            'type'   => Operation::getOperationName($this->resource->type),
            'date'   => $this->resource->date->format('d.m.Y'),
            'amount' => $this->resource->amount,
        ];
    }
}
