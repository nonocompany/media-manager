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
        return FolderResource::collection($this->repository->index());
    }

    public function show(Folder $folder): FolderResource
    {
        return new FolderResource($folder);
    }

    public function store(array $data): FolderResource
    {
        return new FolderResource(folderManager()->make($data));
    }

    public function update(Folder $folder, array $data): FolderResource
    {
return new FolderResource($this->repository->update($folder, $data));
    }

    public function destroy(Folder $folder): bool
    {
        // TODO: Implement destroy() method.
    }


}
