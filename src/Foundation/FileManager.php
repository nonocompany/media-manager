<?php

namespace Nonocompany\MediaManager\Foundation;

use Illuminate\Support\Facades\Storage;
use Nonocompany\MediaManager\Models\File;
use Nonocompany\MediaManager\Models\Folder;
use Nonocompany\MediaManager\Repositories\FileRepository;
use Intervention\Image\Facades\Image;
use Intervention\Image\Image as InterventionImage;

class FileManager
{
    protected File $file;
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
    public bool $webp_conversion = false;
    public int $image_quality = 80;
    protected InterventionImage $image;
    protected string $path;

    public function __construct(private readonly FileRepository $fileRepository)
    {
    }

    public function init(string $slug, array $options = []): string
    {

        $this->setAttributes($slug);
        $this->name = pathinfo($this->name, PATHINFO_FILENAME);
        $this->hash_name = pathinfo($this->hash_name, PATHINFO_FILENAME);
        return $this->getFile($options);

    }


    #region File Attributes
    private function getFile(array $options = []): string
    {
        if (in_array($this->mime_type, ['image/jpeg', 'image/png'])) {
            $queryBuilder = $this->fileRepository->queryBuilder();
            $queryBuilder->where('original_id', $this->file->id)->where('is_clone', true);

            if (isset($options['width'])) {
                $queryBuilder->where('width', $options['width']);
            } elseif (isset($options['height'])) {
                $queryBuilder->where('width', $options['width']);
            }
            if ($this->webp_conversion) {
                $queryBuilder->where('mime_type', 'image/webp');
            }

            $clone = $queryBuilder->first();
            if ($clone) {
                return $this->folder->exists ? $clone->folder->directory . '/' . $clone->hash_name : "medias/" . $clone->hash_name;
            } else {
                return $this->imageProcessing($options);
            }
        } else {
            return $this->file->path;
        }

    }

    private function setAttributes(string $slug): void
    {
        $this->file = $this->fileRepository->getBySlug($slug);
        if ($this->file->folder) {

            $this->folder = $this->file->folder;
        } else {
            $this->folder = new Folder();
        }
        $this->slug = $this->file->slug;
        $this->name = $this->file->name;
        $this->hash_name = $this->file->hash_name;
        $this->mime_type = $this->file->mime_type;
        $this->extension = $this->file->extension;
        $this->size = $this->file->size;
        $this->width = $this->file->width;
        $this->height = $this->file->height;
        $this->directory = $this->folder->exists ? $this->folder->directory . '/' . $this->hash_name : "medias/" . $this->hash_name;
        $this->webp_conversion = config('media-manager.webp_conversion');
        $this->image_quality = config('media-manager.image_quality');
        $this->path = Storage::disk('local')->path($this->directory);
        $this->is_clone = $this->file->is_clone;
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
            'is_clone' => $this->is_clone,
            'original_id' => $this->original_id,
            'folder_id' => $this->folder?->id,
        ];
    }

    private function imageProcessing(array $options = []): string
    {

        if (in_array($this->mime_type, ['image/jpeg', 'image/png'])) {
            $this->image = Image::make($this->path);
            $this->resize($options);
            $this->webpConversion();
            return $this->imageSaving();
        }
    }

    private function resize(array $options = [])
    {
        foreach ($options as $key => $value) {
            if ($key == 'width') {
                $this->width = $value;
                $this->image->resize($value, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $this->name .= "_w{$value}";
            } elseif ($key == 'height') {
                $this->height = $value;
                $this->image->resize(null, $value, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $this->name .= "_h{$value}";
            }
        }

    }


    private function webpConversion()
    {
        if ($this->webp_conversion) {
            $this->image->encode('webp', $this->image_quality);
            $this->extension = 'webp';
            $this->mime_type = 'image/webp';
            $this->hash_name .= ".webp";
            $this->name .= ".webp";
        } else {
            $this->hash_name .= "." . $this->extension;
            $this->name .= "." . $this->extension;
        }
        $newSlug = $this->folder->exists ? $this->folder->directory . '/' . $this->name : "medias/" . $this->name;
        $this->slug = str($newSlug)->slug('-', dictionary: ['/' => '-', '.' => '.']);
    }

    private function imageSaving()
    {
        $newDirectory = $this->folder->exists ? $this->folder->directory . '/' . $this->hash_name : "medias/" . $this->hash_name;
        $this->is_clone = true;
        $this->original_id = $this->file->id;


        $this->image->save(storage_path('app/' . $newDirectory));

        $this->fileRepository->store($this->toArray());

        return $newDirectory;
    }

}
