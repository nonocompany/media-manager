<?php
/**
 * Created by Egemen KIRKAPLAN - egemen.k@nono.company
 * Created on 17.07.2023
 * Project: Media Manager
 * Package: nonocompany\media-manager
 * File: MediaManagerServiceProvider.php
 * Description: Media Manager service provider.
 */

namespace Nonocompany\MediaManager;


use Illuminate\Support\ServiceProvider;
use Nonocompany\MediaManager\Foundation\FileManager;
use Nonocompany\MediaManager\Foundation\FolderManager;
use Nonocompany\MediaManager\Providers\RouteServiceProvider;
use Nonocompany\MediaManager\Foundation\JsonOutput;

class MediaManagerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->bind("JsonOutput", JsonOutput::class);
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadViewsFrom(__DIR__ . '/Resources/views', 'MediaManager');
        $this->loadTranslationsFrom(__DIR__ . '/Lang', 'MediaManager');
        $this->publishes([
            __DIR__.'/Config/media-manager.php' => config_path('media-manager.php'),
        ]);
        require_once __DIR__ . '/Http/helper.php';
    }
}
