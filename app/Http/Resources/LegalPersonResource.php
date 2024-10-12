<?php

namespace App\Http\Resources;

use App\Models\LegalPerson;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property LegalPerson $resource */
class LegalPersonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->resource->id,
            'name'      => $this->resource->name,
            'tin'       => $this->resource->tin,
            'client'    => ClientResource::make($this->resource->client),
            'createdAt' => $this->resource->created_at,
        ];
    }
}
