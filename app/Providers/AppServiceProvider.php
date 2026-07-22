<?php

namespace App\Providers;

use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use App\Http\View\Composers\GlobalDataComposer;

use Illuminate\Pagination\Paginator;

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
        // Helps avoid "Specified key was too long" errors on some MySQL/MariaDB setups
        // when using utf8mb4 + older index limits.
        Schema::defaultStringLength(191);

        View::composer('*', GlobalDataComposer::class);

        Paginator::useBootstrapFour();
    }
}
