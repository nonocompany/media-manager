<?php

namespace Nonocompany\MediaManager\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \Nonocompany\MediaManager\Models\Folder */
class FolderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'name' => $this->name,
            'path' => $this->path,
            "files" => FileResource::collection($this->files)
        ];
    }
}
