<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

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
        View::share('plugins', []);

        Blade::directive('jsScript', function ($str) {
            $path = asset($str . "?q=" . time());
            return '<script src="' . $path . '"></script>';
        });

        if (in_array(env('APP_ENV'), ['production', 'ministry', 'egov'])) {
            \URL::forceScheme('https');
        }
    }
}
