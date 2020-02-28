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
        $this->mapMediaRoutes();
        $this->mapAppRoutes();

        $this->mapWebRoutes();
        $this->mapAdminRoutes();
        $this->mapDataTableRoutes();

        //
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
//            ->middleware('api')
            ->namespace($this->namespace . '\Api')
            ->group(base_path('routes/api.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapAppRoutes()
    {
        Route::middleware('admin')
            ->prefix('admin/app')
            ->namespace($this->namespace . '\Admin\App')
            ->group(base_path('routes/app.php'));
    }

    /**
     * Define the "media" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapMediaRoutes()
    {
        Route::prefix('api-media')
//            ->middleware('admin')
            ->namespace($this->namespace)
            ->group(base_path('routes/media.php'));
    }

    protected function mapAdminRoutes()
    {
        Route::middleware('admin')
            ->prefix('admin')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin.php'));
    }

    protected function mapDataTableRoutes()
    {
        Route::middleware('admin')
            ->prefix('admin')
            ->namespace($this->namespace)
            ->group(base_path('routes/datatable.php'));
    }
}
