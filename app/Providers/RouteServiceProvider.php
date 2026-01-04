<?php

namespace App\Providers;

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
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */

    protected function mapWebRoutes()
    {
        foreach ($this->centralDomains() as $domain) {
            Route::middleware(['installed', 'web', 'version.update', 'addon'])
                ->domain($domain)
                ->namespace($this->namespace)
                ->group(base_path('routes/addon/saas/frontend.php'));

            Route::middleware(['installed', 'web', 'auth', 'version.update', 'addon', 'super-admin', 'is_email_verify', '2fa_verify'])
                ->domain($domain)
                ->namespace($this->namespace)
                ->prefix('super-admin')
                ->as('saas.super_admin.')
                ->group(base_path('routes/addon/saas/super_admin.php'));

            Route::domain($domain)
                ->namespace($this->namespace)
                ->middleware(['web', 'auth', 'admin', 'is_email_verify', '2fa_verify'])
                ->prefix('admin')
                ->as('admin.')
                ->group(base_path('routes/admin.php'));

            Route::domain($domain)
                ->namespace($this->namespace)
                ->middleware([ 'web', 'auth', 'user', 'is_email_verify', '2fa_verify', 'common'])
                ->group(base_path('routes/alumni.php'));

            Route::middleware(['installed', 'web', 'auth', 'version.update', 'addon', 'super-admin', 'is_email_verify', '2fa_verify'])
                ->domain($domain)
                ->namespace($this->namespace)
                ->prefix('super-admin')
                ->as('super_admin.')
                ->group(base_path('routes/super_admin.php'));
        }
    }

    protected function mapApiRoutes()
    {
        foreach ($this->centralDomains() as $domain) {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));
        }
    }

    protected function centralDomains(): array
    {
        return config('tenancy.central_domains');
    }


    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            if(isAddonInstalled('ALUSAAS') && isCentralDomain()){
                $this->mapApiRoutes();
                $this->mapWebRoutes();
            }else{
                $this->allApiRoutes();
                $this->allWebRoutes();
            }
        });
    }

    protected function allWebRoutes()
    {
        Route::middleware(['installed', 'web', 'version.update'])
            ->group(base_path('routes/web.php'));

        Route::middleware(['installed', 'web', 'auth', 'version.update', 'addon', 'super-admin', 'is_email_verify', '2fa_verify'])
            ->prefix('super-admin')
            ->as('super_admin.')
            ->group(base_path('routes/super_admin.php'));

        Route::middleware(['installed', 'web', 'auth', 'admin',  'version.update', 'addon', 'is_email_verify', '2fa_verify'])
            ->prefix('admin')
            ->as('admin.')
            ->group(base_path('routes/admin.php'));

        Route::middleware([ 'installed', 'web', 'auth', 'user', 'version.update', 'addon', 'is_email_verify', '2fa_verify', 'common'])
            ->group(base_path('routes/alumni.php'));

        Route::middleware(['installed', 'web', 'version.update', 'addon'])
            ->group(base_path('routes/frontend.php'));
    }

    protected function allApiRoutes()
    {
        Route::middleware('api')
            ->prefix('api')
            ->group(base_path('routes/api.php'));
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
