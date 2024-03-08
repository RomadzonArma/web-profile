<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/check-access';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        Route::middleware(['web', 'auth'])->group(function () {
            $this->mapDashboardRoutes();

            $this->mapUserRoutes();

            $this->mapMenuRoutes();

            $this->mapOtoritasRoutes();

            $this->mapInformasiRoutes();

            $this->mapListKanalRoutes();

            $this->mapListKategoriRoutes();

            $this->mapListBeritaRoutes();

            $this->mapListBeritaRoutes();

            $this->mapListProfilRoutes();

            $this->mapListProgramLayanan();

            $this->mapListUnduhanRoutes();

            $this->mapSwiper();

            $this->mapSosmedRoutes();

            $this->mapAgendaRoutes();

            $this->mapWebinarRoutes();

            $this->mapPengumumanRoutes();

            $this->mapPanduanRoutes();

            $this->mapRegulasiRoutes();

            $this->mapArtikelRoutes();

            $this->mapGaleriRoutes();

        });
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

    protected function mapDashboardRoutes()
    {
        Route::prefix('dashboard')
            ->namespace($this->namespace)
            ->group(base_path('routes/panel/dashboard.php'));
    }

    protected function mapUserRoutes()
    {
        Route::prefix('users')
            ->namespace($this->namespace)
            ->group(base_path('routes/panel/users.php'));
    }

    protected function mapMenuRoutes()
    {
        Route::prefix('manajemen-menu')
            ->namespace($this->namespace)
            ->group(base_path('routes/panel/menu.php'));
    }

    protected function mapOtoritasRoutes()
    {
        Route::prefix('otoritas')
            ->namespace($this->namespace)
            ->group(base_path('routes/panel/otoritas.php'));
    }

    protected function mapInformasiRoutes()
    {
        Route::prefix('informasi-publik')
            ->namespace($this->namespace)
            ->group(base_path('routes/panel/informasi.php'));
    }

    protected function mapListKanalRoutes()
    {
        Route::prefix('list_kanal')
            ->namespace($this->namespace)
            ->group(base_path('routes/panel/list_kanal.php'));
    }

    protected function mapListKategoriRoutes()
    {
        Route::prefix('list_kategori')
            ->namespace($this->namespace)
            ->group(base_path('routes/panel/list_kategori.php'));
    }

    protected function mapListBeritaRoutes()
    {
        Route::prefix('list_berita')
            ->namespace($this->namespace)
            ->group(base_path('routes/panel/list_berita.php'));
    }

    protected function mapListProfilRoutes()
    {
        Route::prefix('profil')
            ->namespace($this->namespace)
            ->group(base_path('routes/panel/profil.php'));
    }

    protected function mapListProgramLayanan()
    {
        Route::prefix('program_layanan')
            ->namespace($this->namespace)
            ->group(base_path('routes/panel/program-layanan.php'));
    }
    protected function mapListUnduhanRoutes()
    {
        Route::prefix('unduhan')
            ->namespace($this->namespace)
            ->group(base_path('routes/panel/unduhan.php'));
    }

    protected function mapSwiper()
    {
        Route::prefix('swiper')
            ->namespace($this->namespace)
            ->group(base_path('routes/panel/swiper.php'));
    }

    protected function mapSosmedRoutes()
    {
        Route::prefix('sosmed')
            ->namespace($this->namespace)
            ->group(base_path('routes/panel/sosmed.php'));
    }

    protected function mapAgendaRoutes()
    {
        Route::prefix('list_agenda')
            ->namespace($this->namespace)
            ->group(base_path('routes/panel/agenda.php'));
    }

    protected function mapWebinarRoutes()
    {
        Route::prefix('webinar')
            ->namespace($this->namespace)
            ->group(base_path('routes/panel/webinar.php'));
    }

    protected function mapPengumumanRoutes()
    {
        Route::prefix('pengumuman')
            ->namespace($this->namespace)
            ->group(base_path('routes/panel/pengumuman.php'));

    }
    protected function mapPanduanRoutes()
    {
        Route::prefix('manajemen_panduan')
        ->namespace($this->namespace)
        ->group(base_path('routes/panel/panduan.php'));
    }

    protected function mapRegulasiRoutes()
    {
        Route::prefix('regulasi')
        ->namespace($this->namespace)
        ->group(base_path('routes/panel/regulasi.php'));
    }
    protected function mapArtikelRoutes()
    {
        Route::prefix('manajemen_artikel')
        ->namespace($this->namespace)
        ->group(base_path('routes/panel/artikel.php'));
    }
    protected function mapGaleriRoutes()
    {
        Route::prefix('manajemen_galeri')
        ->namespace($this->namespace)
        ->group(base_path('routes/panel/galeri.php'));
    }
}
