<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, and other route services.
     *
     * @return void
     */
    public function map()
    {
        $this->mapUserRoutes();
        $this->mapWebRoutes();

        // Load the frontPageRoutes file
        $this->mapFrontPageRoutes();
    }

    /**
     * Define the "frontPage" routes for the application.
     *
     * @return void
     */
    protected function mapFrontPageRoutes()
    {
        Route::middleware('web')
             ->group(base_path('routes/frontPageRoutes.php'));
    }
    /**
     * Define the "frontPage" routes for the application.
     *
     * @return void
     */
    protected function mapUserRoutes()
    {
        Route::middleware('web')
             ->group(base_path('routes/userRoutes.php'));
    }

    /**
     * Define the "web" routes for the application.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->group(base_path('routes/web.php'));
    }
}

