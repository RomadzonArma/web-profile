<?php

namespace App\Providers;

use App\Model\Sosmed;
use App\Model\Tautan;
use App\Model\Podcast;
use App\Model\ListBerita;
use App\Model\Pengunjung;
use App\Model\Webinar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('layouts.front.header', function ($view) {
            $ref_sosmed = Sosmed::first();
            $view->with('ref_sosmed', $ref_sosmed);
        });
        view()->composer('layouts.front.header_mobile', function ($view) {
            $ref_sosmed = Sosmed::first();
            $view->with('ref_sosmed', $ref_sosmed);
        });
        view()->composer('layouts.front.footer', function ($view) {
            $todayCount = Pengunjung::whereDate('created_at', today())->count();
            $view->with('pengunjungHariIni', $todayCount);
        });
        view()->composer('layouts.front.app', function ($view) {
            $podcast = Podcast::where('status_publish', '1')->orderByDesc('created_at')->get();
            $view->with('podcast', $podcast);
        });
        view()->composer('layouts.front.app', function ($view) {
            $berita = ListBerita::where('status_publish', '1')->orderByDesc('created_at')->get();
            $view->with('berita', $berita);
        });
        view()->composer('contents.Front.menu', function ($view) {
            $tautan = Tautan::all();
            $view->with('tautan', $tautan);
        });
        view()->composer('contents.Front.webinar', function ($view) {
            $webinar = Webinar::all();
            $view->with('webinar', $webinar);
        });
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
