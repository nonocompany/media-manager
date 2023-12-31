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
            'url' => $this->url,
            'size' => $this->getSize(),
            'last_modified' => $this->updated_at->diffForHumans(),
        ];
    }

    private function getSize()
    {
        $bytes = $this->size;
        if ($bytes >= 1073741824) {
            $returnByte = number_format($bytes / 1073741824, 2);
            $unit = 'GB';
        } elseif ($bytes >= 1048576) {
            $returnByte = number_format($bytes / 1048576, 2);
            $unit = 'MB';
        } elseif ($bytes >= 1024) {
            $returnByte = number_format($bytes / 1024, 2);
            $unit = 'KB';
        } elseif ($bytes >= 0) {
            $returnByte = $bytes;
            $unit = 'byte';
        }

        return $returnByte . ' ' . $unit;
    }
}
