<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * The path to the "admin home" route for your application.
     *
     * This is used by Laravel authentication to redirect admins after login.
     *
     * @var string
     */
    public const ADMIN_HOME = '/admin';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            $this->mapApiRoutes();

            $this->mapWebRoutes();

            $this->mapAdminWebRoutes();

            $this->mapProtectedAdminWebRoutes();

            // Этот метод всегда последний
            $this->mapSitePageRoute();
        });

        Route::bind('deletedUser', function ($id) {
            return User::onlyTrashed()->find($id);
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));

        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/frontend/auth.php'));
    }

    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

    protected function mapAdminWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->as('admin.')
            ->prefix('admin')
            ->group(base_path('routes/admin/auth.php'));
    }

    protected function mapProtectedAdminWebRoutes()
    {
        Route::middleware(['web', 'auth.admin'])
            ->as('admin.')
            ->prefix('admin')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin.php'));
    }

    protected function mapSitePageRoute()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/frontend/page.php'));
    }
}
