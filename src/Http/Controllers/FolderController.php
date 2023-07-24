<?php

namespace Nonocompany\MediaManager\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        return response()->json($this->service->index());
    }

    public function store(Request $request)
    {
    }

    public function show(Folder $folder)
    {
    }

    public function update(Request $request, Folder $folder)
    {
    }

    public function destroy(Folder $folder)
    {
    }
}
