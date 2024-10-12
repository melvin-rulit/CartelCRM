<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActiveStatsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'       => $this->resource->id,
            'name'     => $this->resource->getName(),
            'investor' => UserResource::make($this->resource->investor),
            'remain'   => $this->resource->remain,
            'branch'   => BranchResource::make($this->resource->branch),
            'client'   => ClientResource::make($this->resource->deal?->client) ?? null,
        ];
    }
}
