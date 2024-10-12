<?php

namespace App\Http\Resources;

use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property Source $resource */
class SourceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->resource->id,
            'name'       => $this->resource->name,
            'amount'     => $this->resource->amount,
            'percent'    => $this->resource->percent,
            'investor'   => UserResource::make($this->resource->investor),
            'investorId' => $this->resource->investor_id,
        ];
    }
}
