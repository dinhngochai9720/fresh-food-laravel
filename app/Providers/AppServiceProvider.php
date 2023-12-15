<?php

namespace App\Providers;

use App\Models\GeneralSetting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
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
        //Customize pagination
        Paginator::useBootstrap();

        $general_setting = GeneralSetting::first();

        // Customize set time zone
        Config::set('app.timezone', $general_setting->time_zone);

        // Share variables at all view
        View::composer('*', function ($view) use ($general_setting) {
            // '*' is all view
            // use ($general_setting) is use variable in scope
            $view->with('settings', $general_setting);
        });
    }
}
