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
            'size' => $this->getSize(),
            "files" => FileResource::collection($this->files()->where('is_clone', false)->get()),
            "folders" => ChildFolderResource::collection($this->childFolders),
            "breandcrumbs" => $this->breadcrumbs(),
        ];
    }

    private function getSize()
    {
        $totalSize = 0;
        $totalSize += $this->files->sum('size');
        $chiledFolders = $this->childFolders;

        foreach ($chiledFolders as $chiledFolder) {
            $totalSize += $chiledFolder->files->sum('size');
            if ($chiledFolder->childFolders) {
                $chiledFolders = $chiledFolder->childFolders;
            }
        }
        $bytes = $totalSize;
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

    public function breadcrumbs(): array
    {
        $breadcrumbs = [];
        $folder = $this;
        while ($folder->parentFolder) {
            $breadcrumbs[] = [
                'id' => $folder->parentFolder->id,
                'name' => $folder->parentFolder->name,
            ];
            $folder = $folder->parentFolder;
        }
        return array_reverse($breadcrumbs);
    }

}
