<?php

namespace App\Providers;

use App\Repositories\Contracts\User\IAuth;
use App\Repositories\Contracts\User\IAuthorize;
use App\Repositories\Eloquent\User\AuthorizeRepository;
use App\Repositories\Eloquent\User\AuthRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IAuth::class, AuthRepository::class);
        $this->app->bind(IAuthorize::class, AuthorizeRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
