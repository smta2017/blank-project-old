<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Rinvex\Attributes\Models\Attribute;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Attribute::typeMap([
            'varchar' => \Rinvex\Attributes\Models\Type\Varchar::class,
            'Text' =>\Rinvex\Attributes\Models\Type\Text::class,
            'Boolean' =>\Rinvex\Attributes\Models\Type\Boolean::class,
            'Integer' =>\Rinvex\Attributes\Models\Type\Integer::class,
            'Datetime' =>\Rinvex\Attributes\Models\Type\Datetime::class,
        ]);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        app('rinvex.attributes.entities')->push(App\Models\User::class);
    }
}
