<?php

namespace Nonocompany\MediaManager\Contracts\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Nonocompany\MediaManager\Models\Folder;
interface FolderInterface
{
    public function index(): Collection;

    public function store(array $data): Folder;
}
