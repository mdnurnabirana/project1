<?php

namespace App\Providers;

use App\Models\GeneralSetting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;

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
        Paginator::useBootstrap();
        
        $generalSetting = GeneralSetting::first();

        // Set Time Zone
        Config::set('app.timezone', $generalSetting->time_zone);

        // Share Variable to All view
        View::composer('*', function ($view) use ($generalSetting) {
            $view->with('settings', $generalSetting);
        });
    }
}
