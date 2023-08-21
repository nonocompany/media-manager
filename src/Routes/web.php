<?php
use Nonocompany\MediaManager\Http\Controllers\FileController;

Route::view('/', 'MediaManager::index');

Route::controller(FileController::class)->prefix('file')->group(function (){
    Route::get('{slug}', 'getBySlug')->name('file.get-by-slug');
});
