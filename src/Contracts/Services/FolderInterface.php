<?php

namespace Nonocompany\MediaManager\Contracts\Services;

use Illuminate\Http\Resources\Json\JsonResource;
use Nonocompany\MediaManager\Http\Resources\FolderResource;
use Nonocompany\MediaManager\Models\Folder;

interface FolderInterface
{
    /**
     * @return JsonResource
     */
    public function index(): JsonResource;

    /**
     * @param Folder $folder
     * @return FolderResource
     */
    public function show(Folder $folder): FolderResource;

    /**
     * @param array $data
     * @return FolderResource
     */
    public function store(array $data): FolderResource;

    /**
     * @param Folder $folder
     * @param array $data
     * @return FolderResource
     */
    public function update(Folder $folder, array $data): FolderResource;

    /**
     * @param Folder $folder
     * @return bool
     */
    public function destroy(Folder $folder): bool;
}
