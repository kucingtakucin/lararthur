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
    public const HOME = '/';

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

        $this->mapAuthRoutes();

        $this->mapAdminRoutes();

        $this->mapOperatorRoutes();
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
            ->namespace($this->namespace . '\Frontend')
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "auth" routes for the application.
     *
     * @return void
     */
    protected function mapAuthRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/auth.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        $prefix = 'api';
        $namespace = '\Api';
        $middleware = 'api';

        $this->_apiAuth($prefix, $middleware, $namespace);
        $this->_apiMahasiswa($prefix, $middleware, $namespace);
    }

    private function _apiAuth($prefix, $middleware, $namespace)
    {
        Route::prefix($prefix . '/auth')
            ->middleware([$middleware])
            ->namespace($this->namespace . $namespace)
            ->group(base_path('routes/api/auth.php'));
    }

    private function _apiMahasiswa($prefix, $middleware, $namespace)
    {
        Route::prefix($prefix . '/mahasiswa')
            ->middleware([$middleware, 'auth:api'])
            ->namespace($this->namespace . $namespace)
            ->group(base_path('routes/api/mahasiswa.php'));
    }

    /**
     * Define the "admin" routes for the application.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        $prefix = 'backend/admin';
        $namespace = '\Backend\Admin';
        $middleware = ['web', 'auth:web', 'role:admin'];

        $this->_adminDashboard($prefix, $middleware, $namespace);
        $this->_adminMahasiswa($prefix, $middleware, $namespace);
        $this->_adminAccount($prefix, $middleware, $namespace);
    }

    private function _adminDashboard($prefix, $middleware, $namespace)
    {
        Route::prefix($prefix . '/dashboard')
            ->middleware($middleware)
            ->namespace($this->namespace . $namespace)
            ->group(base_path('routes/admin/dashboard.php'));
    }

    private function _adminMahasiswa($prefix, $middleware, $namespace)
    {
        Route::prefix($prefix . '/mahasiswa')
            ->middleware($middleware)
            ->namespace($this->namespace . $namespace)
            ->group(base_path('routes/admin/mahasiswa.php'));
    }

    public function _adminAccount($prefix, $middleware, $namespace)
    {
        Route::prefix($prefix . '/account')
            ->middleware($middleware)
            ->namespace($this->namespace . $namespace)
            ->group(base_path('routes/admin/account.php'));
    }

    /**
     * Define the "operator" routes for the application.
     *
     * @return void
     */
    protected function mapOperatorRoutes()
    {
        $prefix = 'backend/operator';
        $namespace = '\Backend\Operator';
        $middleware = ['web', 'auth:web', 'role:operator'];

        $this->_operatorDashboard($prefix, $middleware, $namespace);
    }

    private function _operatorDashboard($prefix, $middleware, $namespace)
    {
        Route::prefix($prefix . '/dashboard')
            ->middleware($middleware)
            ->namespace($this->namespace . $namespace)
            ->group(base_path('routes/operator/dashboard.php'));
    }
}
