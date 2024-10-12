<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExcelActiveStatsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'     => $this->resource->getName(),
            'investor' => $this->resource->investor?->getFullName(),
            'remain'   => $this->resource->remain,
            'branch'   => $this->resource->branch->getName(),
//            'amount'   => $this->resource->branch->getName(),
            'client'   => $this->resource->deal?->client->getFullName() ?? '-'
        ];
    }
}
