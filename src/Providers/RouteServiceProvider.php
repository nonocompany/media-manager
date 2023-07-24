<?php

namespace Nonocompany\MediaManager\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        parent::boot();
    }

    public function map()
    {
        $this->mapWebRoutes();
        $this->mapApiRoutes();
    }

    protected function mapWebRoutes()
    {
        Route::prefix('medias')->middleware('web')->group(function ($router) {
            require __DIR__ . '/../Routes/web.php';
        });
    }

    protected function mapApiRoutes()
    {
        Route::prefix('medias/api')->middleware('api')->group(function ($router) {
            require __DIR__ . '/../Routes/api.php';
        });
    }
}
