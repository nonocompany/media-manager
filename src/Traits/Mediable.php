<?php

namespace Nonocompany\MediaManager\Traits;

use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Nonocompany\MediaManager\Models\File;

trait Mediable
{
    public function medias(): MorphToMany
    {
        return $this->morphToMany(File::class, 'model', 'file_model');
    }

    public function mediasSync(array $medias): void
    {
        $save = [];
        foreach ($medias as $key => $mediaIds) {
            if ($mediaIds) {
                if (!is_array($mediaIds)) {
                    $save[$mediaIds] = ['key' => $key];
                } else {
                    foreach ($mediaIds as $mediaId) {
                        $save[$mediaId] = ['key' => $key];
                    }
                }
            }
        }
        $this->medias()->sync($save);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            $data = request('medias', '');
            if ($data) {
                $model->mediasSync($data);
            }
        });

        static::updated(function ($model) {
            $data = request('medias', '');
            if ($data) {
                $model->mediasSync($data);
            }
        });
    }

    public function __get($key)
    {
        $attribute = $this->getAttribute($key);

        if ($attribute) {
            return $attribute;
        }

        if (str()->startsWith($key, 'mf_')) {
            $key = mb_substr($key, 3);
            $medias = $this->medias();
            if ($key) {
                $medias->wherePivot('key', $key);
            }
            return $medias->first() ? $medias->first() : new File();
        } elseif (str()->startsWith($key, 'mc_')) {
            $key = mb_substr($key, 3);
            $medias = $this->medias();
            if ($key) {
                $medias->wherePivot('key', $key);
            }
            return $medias->get();
        }

        return $attribute;
    }
}
