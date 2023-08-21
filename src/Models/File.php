<?php

namespace Nonocompany\MediaManager\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use HasUuids, SoftDeletes;

    protected $fillable = [
        'folder_id',
        'is_clone',
        'original_id',
        'name',
        'slug',
        'hash_name',
        'mime_type',
        'extension',
        'size',
        'disk',
        'width',
        'height'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'url',
        'path'
    ];

    public function folder(): BelongsTo
    {
        return $this->belongsTo(Folder::class);
    }

    public function url(): Attribute
    {
        return new Attribute(
            get: fn($value) => route('medias.file.get-by-slug', $this->slug)
        );
    }

    public function path(): Attribute
    {
        return new Attribute(
            get: fn($value) => ($this->folder ? ($this->folder->directory . '/') : 'medias/') . $this->hash_name
        );
    }

    public function __toString()
    {
        return $this->url();
    }
}
