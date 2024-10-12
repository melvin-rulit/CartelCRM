<?php

namespace App\Http\Resources;

use App\Models\Operation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property Operation $resource */
class OperationStatsResource extends JsonResource
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
            'createdAt'     => $this->resource->date->format('d.m.Y'),
            'type'          => Operation::getOperationName($this->resource->type),
            'amount'        => $this->resource->amount,
            'operationName' => $this->resource->name,
            'activeName'    => $this->resource->active?->getName(),
            'branchName'    => $this->resource->active?->branch->getName(),
            'clientName'    => '-',
            'timestamp'     => $this->resource->date->format('U'),
            'kind'          => 'operation'
        ];
    }
}
