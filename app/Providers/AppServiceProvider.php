<?php

namespace App\Providers;
use App\View\Components\ApplicationMark;
use App\View\Components\ApplicationLogo;
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
        Blade::component('application-mark', ApplicationMark::class);
    Blade::component('application-logo', ApplicationLogo::class);
    }
}
