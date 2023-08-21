<?php

namespace Nonocompany\MediaManager\Foundation;

use Illuminate\Support\Facades\Storage;
use Nonocompany\MediaManager\Models\Folder;
use Nonocompany\MediaManager\Repositories\FolderRepository;
use function PHPUnit\Framework\isNull;

readonly class FolderManager
{
    public function __construct(protected FolderRepository $repository)
    {
    }

    public function make(array $data): Folder
    {
        $folderName = $data['name'];
        $parentFolder = $data['parent_id'];

        $folderDirectory = $this->folderDirectoryBuild($data);

        return $folderDirectory;
    }

    public function update(Folder $folder, string $name)
    {
        $currentDirectory = $folder->directory;
    }

    public function folderDirectoryBuild(array $data): Folder
    {
        $folderName = $data['name'];
        $parentFolder = $data['parent_id'];
        $folderDirectory = "medias";

        while ($parentFolder) {
            $parent = Folder::where('id', $parentFolder)->first();
            if ($parent) {
                $parentFolder = $parent->parent_id;
            }

            $folderDirectory .= $parent->directory;
        }

        $folderDirectory .= "/" . str($folderName)->snake();

        while (Storage::exists($folderDirectory)) {
            $folderDirectory .= "-" . rand(0, 9);
        }

        Storage::makeDirectory($folderDirectory);

        return $this->repository->store([
            'name' => $folderName,
            'parent_id' => $data['parent_id'],
            'directory' => $folderDirectory,
        ]);
    }
}
