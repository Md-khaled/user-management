<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Route::macro('softDeletes', function ($resource, $controller, $options = []): void {
            $controller = "\\App\Http\Controllers\User\\" . $controller;

            Route::group($options, function () use ($resource, $controller): void {
                Route::get($resource . '/trashed', $controller . '@trashed')->name($resource . '.trashed');
                Route::patch($resource . '/{' . $resource . '}/restore', $controller . '@restore')->name($resource . '.restore');
                Route::delete($resource . '/{' . $resource . '}/delete', $controller . '@delete')->name($resource . '.delete');
            });
        });
    }
}
