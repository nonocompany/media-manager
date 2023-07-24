<?php

namespace Nonocompany\MediaManager\Services;

use Illuminate\Http\Resources\Json\JsonResource;
use Nonocompany\MediaManager\Contracts\Services\FolderInterface;
use Nonocompany\MediaManager\Http\Resources\FolderResource;
use Nonocompany\MediaManager\Models\Folder;
use Nonocompany\MediaManager\Repositories\FolderRepository;

readonly class FolderService implements FolderInterface
{
    public function __construct(private FolderRepository $repository)
    {
    }

    public function index(): JsonResource
    {
        $data = [
            'name' => 'test',
            'parent_id' => null,
            'directory' => null,
        ];
        folderManager()->make($data);
        return FolderResource::collection($this->repository->index());
    }

    public function show(Folder $folder): FolderResource
    {
        return new FolderResource($folder);
    }

    public function store(array $data): FolderResource
    {
        folderManager()->make($data);
    }

    public function update(Folder $folder, array $data): FolderResource
    {
        // TODO: Implement update() method.
    }

    public function destroy(Folder $folder): bool
    {
        // TODO: Implement destroy() method.
    }


}
