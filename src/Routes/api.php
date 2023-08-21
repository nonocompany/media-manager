<?php
use Nonocompany\MediaManager\Http\Controllers\FolderController;
use Nonocompany\MediaManager\Http\Controllers\FileController;

Route::apiResource('folders', FolderController::class);



Route::controller(FileController::class)->prefix('files')->group(function (){
   Route::post('upload/{folder?}', 'store');
});
Route::apiResource('files', FileController::class)->except(['store']);
