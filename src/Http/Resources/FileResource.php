<?php

namespace Nonocompany\MediaManager\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \Nonocompany\MediaManager\Models\File */
class FileResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'folder_id' => $this->folder_id,
            'is_clone' => $this->is_clone,
            'original_id' => $this->original_id,
            'name' => $this->name,
            'hash_name' => $this->hash_name,
            'mime_type' => $this->mime_type,
            'extension' => $this->extension,
            'size' => $this->size,
            'disk' => $this->disk,
            'width' => $this->width,
            'height' => $this->height,
            'folder' => new FolderResource($this->folder)
        ];
    }
}
