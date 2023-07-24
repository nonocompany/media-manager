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
use Nonocompany\MediaManager\Providers\RouteServiceProvider;

class MediaManagerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadViewsFrom(__DIR__ . '/Resources/views', 'MediaManager');
    }
}
