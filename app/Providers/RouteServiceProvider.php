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

    protected function mapAuthRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/auth.php'));
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

    protected function mapAdminRoutes()
    {
        $prefix = 'backend/admin';
        $namespace = '\Backend\Admin';
        $middleware = ['web', 'auth:web', 'role:admin'];

        $this->_adminDashboard($prefix, $middleware, $namespace);
        $this->_adminMahasiswa($prefix, $middleware, $namespace);
        $this->_adminRoles($prefix, $middleware, $namespace);
        $this->_adminPermissions($prefix, $middleware, $namespace);
        $this->_adminUser($prefix, $middleware, $namespace);
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

    private function _adminRoles($prefix, $middleware, $namespace)
    {
        Route::prefix($prefix . '/roles')
            ->middleware($middleware)
            ->namespace($this->namespace . $namespace)
            ->group(base_path('routes/admin/roles.php'));
    }

    private function _adminPermissions($prefix, $middleware, $namespace)
    {
        Route::prefix($prefix . '/permissions')
            ->middleware($middleware)
            ->namespace($this->namespace . $namespace)
            ->group(base_path('routes/admin/permissions.php'));
    }

    private function _adminUser($prefix, $middleware, $namespace)
    {
        Route::prefix($prefix . '/user')
            ->middleware($middleware)
            ->namespace($this->namespace . $namespace)
            ->group(base_path('routes/admin/user.php'));
    }
}
