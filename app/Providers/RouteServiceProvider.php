<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider {
    /**
     * The path to the "home" route for your application.
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * If specified, this namespace is automatically applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = null;

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot() {
        $this->configureRateLimiting();

        $this->routes(function () {
            /**
             * Load Web Routes
             */
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            /**
             * Load System Routes
             */
            Route::middleware('web')
                ->group(base_path('routes/system/index.php'));

            /**
             * Load Frontend Routes
             */
            Route::middleware('web')
                ->group(base_path('routes/frontend/index.php'));

            /**
             * Load Dashboard Routes
             */
            Route::middleware(['web', 'auth', 'verified'])
                ->prefix('dashboard')
                ->group(base_path('routes/dashboard/index.php'));

            /**
             * Load Api Routes
             */
            Route::prefix('api')
                ->middleware('api')
                ->group(base_path('routes/api/index.php'));

        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting() {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60);
        });
    }
}