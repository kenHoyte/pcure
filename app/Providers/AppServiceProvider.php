<?php

namespace App\Providers;

use App\Http\Middleware\Manager;
use App\Http\Middleware\Officer;
use App\Http\Middleware\Operator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        $router = $this->app['router'];

        $router->aliasMiddleware('operator', Operator::class);
        $router->aliasMiddleware('manager', Manager::class);
        $router->aliasMiddleware('officer', Officer::class);
    }
}
