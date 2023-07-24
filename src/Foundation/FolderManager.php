<?php

namespace Nonocompany\MediaManager\Foundation;

use Illuminate\Support\Facades\Storage;
use Nonocompany\MediaManager\Models\Folder;

readonly class FolderManager
{

    public function make(array $data): Folder|bool
    {
        $folderName = $data['name'];
        $parentFolder = $data['parent_id'];

        $folderDirectory = $this->folderDirectoryBuild($data);
        if (Storage::has($folderDirectory)) {
            return false;
        }


    }

    public function folderDirectoryBuild(array $data): string
    {
        $folder = Folder::find($parentId);

        if ($folder->parent_id) {
            return $this->folderDirectoryBuild($folder->parent_id) . '/' . $folder->name;
        }

        return $folder->name;
    }
}
