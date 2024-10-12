<?php

namespace App\Http\Resources;

use App\Models\Active;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property Active $resource */
class ActiveResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->resource->id,
            'model'          => $this->resource->model,
            'bodyNumber'     => $this->resource->body_number,
            'regNumber'      => $this->resource->reg_number,
            'year'           => $this->resource->year,
            'colorId'        => $this->resource->color_id,
            'cost'           => $this->resource->cost,
            'costOfRent'     => $this->resource->cost_of_rent,
            'costOfBuyout'   => $this->resource->cost_of_buyout,
            'investorId'     => $this->resource->investor_id,
            'investor'       => UserResource::make($this->resource->investor),
            'branchId'       => $this->resource->branch_id,
            'branch'         => BranchResource::make($this->resource->branch),
            'osago'          => $this->resource->osago,
            'osagoPrintable' => Carbon::parse($this->resource->osago)->format('d.m.Y'),
            'osagoNumber'    => $this->resource->osago_number,
            'documentSeries' => $this->resource->document_series,
            'documentNumber' => $this->resource->document_number,
            'documentDate'   => $this->resource->document_date->format('Y-m-d'),
            'documentNotes'  => $this->resource->document_notes,
            'createdAt'      => $this->resource->created_at->format('d.m.Y H:i'),
        ];
    }
}
