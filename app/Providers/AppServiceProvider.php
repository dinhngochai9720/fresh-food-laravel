<?php

namespace App\Providers;

use App\Models\EmailConfigSetting;
use App\Models\GeneralSetting;
use App\Models\PusherSetting;
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
        $mail_setting = EmailConfigSetting::first();
        $pusher_setting = PusherSetting::first();

        // Set mail config
        Config::set('mail.mailers.smtp.host', $mail_setting->mail_host);
        Config::set('mail.mailers.smtp.port', $mail_setting->mail_port);
        Config::set('mail.mailers.smtp.encryption', $mail_setting->mail_encryption);
        Config::set('mail.mailers.smtp.username', $mail_setting->username_smtp);
        Config::set('mail.mailers.smtp.password', $mail_setting->password_smtp);
        Config::set('mail.from.address', $mail_setting->email);

        // set pusher config
        Config::set('broadcasting.connections.pusher.key', $pusher_setting->key);
        Config::set('broadcasting.connections.pusher.secret', $pusher_setting->secret);
        Config::set('broadcasting.connections.pusher.app_id', $pusher_setting->app_id);
        Config::set('broadcasting.connections.pusher.options.cluster', $pusher_setting->cluster);
        Config::set('broadcasting.connections.pusher.options.host', "api-" . $pusher_setting->cluster . ".pusher.com");
        // dd(Config::get("broadcasting"));

        // Customize set time zone
        Config::set('app.timezone', $general_setting->time_zone);

        // Share variables at all view
        View::composer('*', function ($view) use ($general_setting, $pusher_setting) {
            // '*' is all view
            // use ($general_setting) is use variable in scope
            $view->with(['settings' => $general_setting, "pusher_setting" => $pusher_setting]);
        });
    }
}
