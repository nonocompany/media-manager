<?php

namespace Nonocompany\MediaManager\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Nonocompany\MediaManager\Facades\JsonOutput;
use Nonocompany\MediaManager\Http\Requests\Folder\StoreRequest;
use Nonocompany\MediaManager\Http\Requests\Folder\UpdateRequest;
use Nonocompany\MediaManager\Models\Folder;
use Nonocompany\MediaManager\Services\FolderService;
use Symfony\Component\HttpFoundation\JsonResponse;

class FolderController extends Controller
{
    public function __construct(readonly private FolderService $service)
    {
    }

    public function index(): JsonResponse
    {
        return JsonOutput::setData($this->service->index())->response();
    }

    public function store(StoreRequest $request)
    {
        return JsonOutput::setData($this->service->store($request->validated()))->response();
    }

    public function show(Folder $folder)
    {
        return JsonOutput::setData($this->service->show($folder))->response();
    }

    public function update(UpdateRequest $request, Folder $folder)
    {
        return JsonOutput::setData($this->service->update($request->validated(), $folder))->response();
    }

    public function destroy(Folder $folder)
    {

    }
}
