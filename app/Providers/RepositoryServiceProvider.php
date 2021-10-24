<?php

namespace App\Providers;

use App\Repositories\Contracts\IBase;
use App\Repositories\Contracts\User\IAuth;
use App\Repositories\Contracts\User\IAuthorize;
use App\Repositories\Contracts\User\IUser;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\User\AuthorizeRepository;
use App\Repositories\Eloquent\User\AuthRepository;
use App\Repositories\Eloquent\User\UserRepository;
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
        $this->app->bind(IUser::class, UserRepository::class);
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
