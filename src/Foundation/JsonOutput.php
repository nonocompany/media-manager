<?php

namespace Nonocompany\MediaManager\Foundation;

use Illuminate\Http\JsonResponse;
use Nonocompany\MediaManager\Models\File;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class JsonOutput
{

    /**
     * @var bool
     */
    protected bool $status = true;
    /**
     * @var int
     */
    protected int $statusCode = 200;
    /**
     * @var array
     */
    protected mixed $data = [];
    /**
     * @var string
     */
    protected string $message = "";

    /**
     * @return JsonResponse
     */
    public function response(): JsonResponse
    {
        $response = [
            'status' => $this->status,
            'data' => $this->data,
            'message' => $this->message
        ];
        return response()->json($response, $this->statusCode)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    }

    public function fileResponse(string $path): BinaryFileResponse
    {
        return response()->file($path, [
            'Cache-Control' => 'max-age=31536000, public',
        ]);
    }

    /**
     * @param  array  $data
     * @return $this
     */
    public function setData(mixed $data): self
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @param  string  $message
     * @return $this
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @param  bool  $status
     * @return $this
     */
    public function setStatus(bool $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param  int  $code
     * @return $this
     */
    public function setStatusCode(int $code): self
    {
        $this->statusCode = $code;
        return $this;
    }


}
