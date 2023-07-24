<?php

namespace Nonocompany\MediaManager\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use SoftDeletes, HasUuids;

    protected $fillable = [
        'folder_id',
        'is_clone',
        'original_id',
        'name',
        'hash_name',
        'mime_type',
        'extension',
        'size',
        'disk',
        'width',
        'height',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function folder(): BelongsTo
    {
        return $this->belongsTo(Folder::class);
    }


}
