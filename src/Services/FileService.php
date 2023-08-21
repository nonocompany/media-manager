<?php

namespace Nonocompany\MediaManager\Services;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Nonocompany\MediaManager\Http\Resources\FileResource;
use Nonocompany\MediaManager\Models\File;
use Nonocompany\MediaManager\Models\Folder;
use Nonocompany\MediaManager\Repositories\FileRepository;

readonly class FileService
{
    public function __construct(private FileRepository $repository)
    {
    }

    public function index(): JsonResource
    {
        return FileResource::collection($this->repository->index());
    }

    public function show(File $file): FileResource
    {
        return new FileResource($file);
    }

    public function store(UploadedFile $file, ?Folder $folder): FileResource
    {
        return new FileResource(fileUploader()->upload($file, $folder));
    }

    public function delete(File $file): bool
    {
        return fileManager()->deleteFile($file);
    }

    public function getFile(string $slug, array $data = [])
    {
        return Storage::disk('local')->path(fileManager()->init($slug, $data));
    }
}
