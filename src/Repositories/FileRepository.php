<?php

namespace Nonocompany\MediaManager\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Nonocompany\MediaManager\Models\File;

readonly class FileRepository
{
    public function __construct(protected File $file)
    {
    }

    public function index(): Collection
    {
        return $this->file->whereNull('folder_id')->where('is_clone', false)->get();
    }

    public function store(array $data): File
    {
        return $this->file->create($data);
    }

    public function delete(File $file): bool
    {
        return $file->delete();
    }

    public function existSlug(string $slug): bool
    {
        return $this->file->where('slug', $slug)->exists();
    }

    public function getBySlug(string $slug): File
    {
        return $this->file->where('slug', $slug)->firstOrFail();
    }

    public function queryBuilder(): Builder
    {
        return $this->file->query();
    }
}
