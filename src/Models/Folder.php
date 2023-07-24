<?php

namespace Nonocompany\MediaManager\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Folder extends Model
{
    use HasUuids, SoftDeletes;

    protected $fillable = [
        'name',
        'parent_id',
        'directory',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function medias(): HasMany
    {
        return $this->hasMany(Media::class);
    }

    public function childFolders(): HasMany
    {
        return $this->hasMany(Folder::class, 'parent_id', 'id');
    }

    public function parentFolder(): BelongsTo
    {
        return $this->belongsTo(Folder::class, 'parent_id', 'id');
    }
}
