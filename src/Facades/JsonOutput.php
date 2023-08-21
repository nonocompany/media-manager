<?php
namespace Nonocompany\MediaManager\Facades;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Facade;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * @method static JsonResponse response()
 * @method static BinaryFileResponse fileResponse()
 * @method static self setData(mixed $data)
 * @method static self setMessage(string $message)
 * @method static self setStatus(bool $status)
 * @method static self setStatusCode(int $code)
 * @see \Nonocompany\MediaManager\Foundation\JsonOutput
 */
class JsonOutput extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'JsonOutput';
    }
}
