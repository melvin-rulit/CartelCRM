<?php

namespace App\Http\Resources;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property File $resource */
class ClientFileResource extends JsonResource
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
            'filename'  => $this->resource->filename,
            'filesize'  => round($this->resource->filesize / 1024 / 1024, 2),
            'path'      => \Storage::disk('public')->url($this->resource->path),
            'createdAt' => $this->resource->created_at->format('d.m.Y H:i:s')
        ];
    }
}
