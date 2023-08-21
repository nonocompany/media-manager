<?php
namespace Nonocompany\MediaManager\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Nonocompany\MediaManager\Contracts\Repositories\FolderInterface;
use Nonocompany\MediaManager\Models\Folder;

readonly class FolderRepository implements FolderInterface
{
    public function __construct(private Folder $folder)
    {
    }

    /**
     * @return Collection
     */
    public function index(): Collection
    {
        return $this->folder->whereNull('parent_id')->get();
    }

    /**
     * @param array $data
     * @return Folder
     */
    public function store(array $data): Folder
    {
        return $this->folder->create($data);
    }

    /**
     * @param Folder $folder
     * @param array $data
     * @return Folder
     */
    public function update(Folder $folder, array $data): Folder
    {
        $folder->update($data);

        return $folder;
    }

    /**
     * @param Folder $folder
     * @return bool
     */
    public function destroy(Folder $folder): bool
    {
        return $folder->delete();
    }

}
