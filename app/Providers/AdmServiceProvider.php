<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AdmServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers\Adm';

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mapAdmRoutes();
    }

    /**
     * Define the "adm" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapAdmRoutes()
    {
        Route::namespace($this->namespace)
            ->middleware('adm')
            ->prefix('admin')
            ->group(base_path('routes/adm.php'));
    }
}
