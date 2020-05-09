<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

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

    protected $apiNamespace = 'App\Http\Controllers\Api';

    protected $backofficeNamespace = 'App\Http\Controllers\Backoffice';


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

        $this->mapBackOfficeRoutes();

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
        Route::domain(config('app.url'))
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
        Route::domain(config('app.api_url'))
             ->middleware('api')
             ->namespace($this->apiNamespace)
             ->group(base_path('routes/api.php'));
    }
    /**
     * Define the "bo" routes for the application.
     *
     * 
     *
     * @return void
     */
    protected function mapBackOfficeRoutes()
    {
        Route::domain(config('app.bo_url'))
             ->namespace($this->backofficeNamespace)
             ->group(base_path('routes/backoffice.php'));
    }
}
