<?php

namespace App\Providers;

use App\Models\SystemProfile;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if($this->app->environment('production')) {
            URL::forceScheme('https');
        }
        $logo = SystemProfile::find(1);
        Config::set('church_logo', $logo->church_logo);
        View::share('church_logo', $logo->church_logo);
        Config::set('church_name', $logo->church_name);
        View::share('church_name', $logo->church_name);
        Config::set('church_address', $logo->church_address);
        View::share('church_address', $logo->church_address);
        Config::set('church_image', $logo->church_image);
        View::share('church_image', $logo->church_image);
        Config::set('church_body', $logo->church_body);
        View::share('church_body', $logo->church_body);
    }
}
