<?php

namespace App\Providers;

use App\Interfaces\User\UserInterface;
use App\Repositories\User\UserRepository as UserUserRepository;
use App\Repositories\UserRepository;
use App\Services\User\UserService as UserUserService;
use Illuminate\Support\ServiceProvider;

class UserRepoServiceProvide extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            UserInterface::class,
            UserUserRepository::class
        );

        $this->app->bind(
            UserUserService::class, 
            function ($app) {
                return new UserUserService($app->make(UserInterface::class));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
