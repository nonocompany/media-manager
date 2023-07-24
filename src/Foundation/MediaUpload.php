<?php
namespace Nonocompany\MediaManager\Foundation;
use Nonocompany\MediaManager\Models\Media;
readonly class MediaUpload
{
    public function __construct(protected Media $media)
    {
    }
}
