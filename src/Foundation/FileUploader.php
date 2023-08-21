<?php

namespace Nonocompany\MediaManager\Foundation;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Nonocompany\MediaManager\Models\File;
use Nonocompany\MediaManager\Models\Folder;
use Nonocompany\MediaManager\Repositories\FileRepository;
use Nonocompany\MediaManager\Repositories\FolderRepository;

class FileUploader
{
    public function __construct(readonly protected FileRepository $fileRepository, readonly protected FolderRepository $folderRepository)
    {
    }

    protected UploadedFile $uploadedFile;
    protected ?Folder $folder;
    protected string $folder_id = "";
    protected bool $is_clone = false;
    protected string $original_id = "";
    protected string $slug = "";
    protected string $name = "";
    protected string $hash_name = "";
    protected string $mime_type = "";
    protected string $extension = "";
    protected int $size = 0;
    protected string $disk = "";
    protected int|null $width = null;
    protected int|null $height = null;
    protected string $directory = "";

    public function upload(UploadedFile $file, ?Folder $folder): File
    {
        $this->init($file, $folder);

        Storage::disk('local')->put("$this->directory", $this->uploadedFile);

        return $this->fileRepository->store($this->toArray());
    }

    public function getFile(string $slug, array $data = [])
    {
        $file = $this->fileRepository->getBySlug($slug);

        $this->init($file, $file->folder);
        dd($this->toArray());
    }

    protected function init(UploadedFile $file, ?Folder $folder): void
    {
        $this->uploadedFile = $file;
        $this->folder = $folder;
        $this->setFileDirectory();
        $this->fileNaming();
        $this->fileSlugable();
        $this->fileHashNaming();
        $this->setFileAttributes();

    }

    public function deleteFile(File $file): bool
    {
        if (Storage::disk('local')->delete($file->directory . $file->hash_name)) {
            return $this->fileRepository->delete($file);
        }
        return false;
    }


    #region Helpers

    private function fileNaming(): void
    {
        $this->name = $this->uploadedFile->getClientOriginalName();

    }

    private function setFileDirectory(): void
    {
        $directory = "";
        $this->folder->exists ? $directory .= $this->folder->directory : $directory = "/medias/";
        $this->directory = $directory;
    }

    private function fileHashNaming(): void
    {
        $this->hash_name = $this->uploadedFile->hashName();
    }

    private function setFileAttributes(): void
    {
        $this->mime_type = $this->uploadedFile->getMimeType();
        $this->extension = $this->uploadedFile->getClientOriginalExtension();
        $this->size = $this->uploadedFile->getSize();
    }

    private function toArray(): array
    {
        return [
            'name' => $this->name,
            'hash_name' => $this->hash_name,
            'mime_type' => $this->mime_type,
            'slug' => $this->slug,
            'extension' => $this->extension,
            'size' => $this->size,
            'disk' => $this->disk,
            'width' => $this->width,
            'height' => $this->height,
            'directory' => $this->directory,
            'folder_id' => $this->folder?->id,
        ];
    }

    private function fileExists(string $fileName)
    {
        $fileDirectory = "";
        $this->folder->exists ? $fileDirectory .= $this->folder->directory : $fileDirectory = "/medias/";
        $fileDirectory .= $fileName;

        return Storage::disk('local')->exists($fileDirectory);
    }

    private function fileSlugable(): void
    {
        $slug = str($this->directory)->slug(dictionary: ['/' => '-'])."-". str(pathinfo($this->name, PATHINFO_FILENAME))->slug(dictionary: ['/' => '-']).".".$this->uploadedFile->getClientOriginalExtension();
        $counter = 1;
        while ($this->fileRepository->existSlug($slug)) {
            $slug = str($this->directory)->slug(dictionary: ['/' => '-'])."-". str(pathinfo($this->name, PATHINFO_FILENAME))->slug(dictionary: ['/' => '-'])."-$counter".".".$this->uploadedFile->getClientOriginalExtension();
            $counter++;
        }
        $this->slug = $slug;
    }
}
#region Helpers end
