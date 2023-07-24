<?php

namespace Nonocompany\MediaManager\Contracts\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Nonocompany\MediaManager\Models\Folder;

interface FolderInterface
{
    /**
     * @return Collection
     */
    public function index(): Collection;

    /**
     * @param array $data
     * @return Folder
     */
    public function store(array $data): Folder;

    /**
     * @param Folder $folder
     * @param array $data
     * @return Folder
     */
    public function update(Folder $folder, array $data): Folder;

    /**
     * @param Folder $folder
     * @return bool
     */
    public function destroy(Folder $folder): bool;
}
