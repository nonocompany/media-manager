<?php

namespace Nonocompany\MediaManager\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Nonocompany\MediaManager\Facades\JsonOutput;
use Nonocompany\MediaManager\Http\Requests\File\OptionsRequest;
use Nonocompany\MediaManager\Http\Requests\File\UploadRequest;
use Nonocompany\MediaManager\Models\File;
use Nonocompany\MediaManager\Models\Folder;
use Nonocompany\MediaManager\Services\FileService;
use Symfony\Component\HttpFoundation\JsonResponse;

class FileController extends Controller
{
    public function __construct(readonly private FileService $service)
    {
    }

    public function index(): JsonResponse
    {
        return JsonOutput::setData($this->service->index())->response();
    }

    public function store(UploadRequest $request, ?Folder $folder): JsonResponse
    {
        return JsonOutput::setData($this->service->store($request->file('file'), $folder))->response();
    }

    public function show(File $file): JsonResponse
    {
        return JsonOutput::setData($this->service->show($file))->response();
    }

    public function getBySlug(OptionsRequest $request, string $slug)
    {
        return JsonOutput::fileResponse($this->service->getFile($slug, $request->validated()));
    }

    public function destroy(File $file): JsonResponse
    {
        return JsonOutput::setStatus($this->service->delete($file))->response();
    }
}
