<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Stancl\JobPipeline\JobPipeline;
use Stancl\Tenancy\Controllers\TenantAssetsController;
use Stancl\Tenancy\Events;
use Stancl\Tenancy\Jobs;
use Stancl\Tenancy\Listeners;
use Stancl\Tenancy\Middleware;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomainOrSubdomain;

class TenancyServiceProvider extends ServiceProvider
{
    // By default, no namespace is used to support the callable array syntax.
    public static string $controllerNamespace = '';

    public function events()
    {
        return [
            // Tenant events
            Events\CreatingTenant::class => [],
            Events\TenantCreated::class => [
                JobPipeline::make([


                ])->send(function (Events\TenantCreated $event) {
                    return $event->tenant;
                })->shouldBeQueued(false), // `false` by default, but you probably want to make this `true` for production.
            ],
            Events\SavingTenant::class => [],
            Events\TenantSaved::class => [],
            Events\UpdatingTenant::class => [],
            Events\TenantUpdated::class => [],
            Events\DeletingTenant::class => [],
            Events\TenantDeleted::class => [
                JobPipeline::make([
                    Jobs\DeleteDatabase::class,
                ])->send(function (Events\TenantDeleted $event) {
                    return $event->tenant;
                })->shouldBeQueued(false), // `false` by default, but you probably want to make this `true` for production.
            ],

            // Domain events
            Events\CreatingDomain::class => [],
            Events\DomainCreated::class => [],
            Events\SavingDomain::class => [],
            Events\DomainSaved::class => [],
            Events\UpdatingDomain::class => [],
            Events\DomainUpdated::class => [],
            Events\DeletingDomain::class => [],
            Events\DomainDeleted::class => [],

            // Database events
            Events\DatabaseCreated::class => [],
            Events\DatabaseMigrated::class => [],
            Events\DatabaseSeeded::class => [],
            Events\DatabaseRolledBack::class => [],
            Events\DatabaseDeleted::class => [],

            // Tenancy events
            Events\InitializingTenancy::class => [],
            Events\TenancyInitialized::class => [
                Listeners\BootstrapTenancy::class,
            ],

            Events\EndingTenancy::class => [],
            Events\TenancyEnded::class => [
                Listeners\RevertToCentralContext::class,
            ],

            Events\BootstrappingTenancy::class => [],
            Events\TenancyBootstrapped::class => [],
            Events\RevertingToCentralContext::class => [],
            Events\RevertedToCentralContext::class => [],

            // Resource syncing
            Events\SyncedResourceSaved::class => [
                Listeners\UpdateSyncedResource::class,
            ],

            // Fired only when a synced resource is changed in a different DB than the origin DB (to avoid infinite loops)
            Events\SyncedResourceChangedInForeignDatabase::class => [],
        ];
    }

    public function register()
    {
        //
    }

    public function boot()
    {
        $this->bootEvents();

        if(isAddonInstalled('ALUSAAS')) {
            $this->mapAdminRoutes();
            $this->mapFrontendRoutes();
        }

        $this->makeTenancyMiddlewareHighestPriority();
        TenantAssetsController::$tenancyMiddleware = InitializeTenancyByDomainOrSubdomain::class;
    }

    protected function bootEvents()
    {
        foreach ($this->events() as $event => $listeners) {
            foreach ($listeners as $listener) {
                if ($listener instanceof JobPipeline) {
                    $listener = $listener->toListener();
                }

                Event::listen($event, $listener);
            }
        }
    }

    protected function mapAdminRoutes()
    {
        Route::namespace(static::$controllerNamespace)->middleware(['tenancy', Middleware\InitializeTenancyByDomain::class, Middleware\PreventAccessFromCentralDomains::class])->group(function() {
            Route::middleware(['web'])
                ->group(base_path('routes/web.php'));

            Route::namespace(static::$controllerNamespace)->middleware(['web', 'auth', 'subscription', 'admin', 'is_email_verify', '2fa_verify'])
                ->prefix('admin')
                ->as('admin.')
                ->group(base_path('routes/admin.php'));

            Route::namespace(static::$controllerNamespace)->middleware([ 'web', 'auth', 'subscription', 'user', 'is_email_verify', '2fa_verify', 'common'])
                ->group(base_path('routes/alumni.php'));
        });
    }

    protected function mapFrontendRoutes()
    {
        Route::namespace(static::$controllerNamespace)->middleware(['tenancy',  Middleware\InitializeTenancyByDomain::class, Middleware\PreventAccessFromCentralDomains::class])->group(function() {
            Route::middleware(['web'])
                ->group(base_path('routes/frontend.php'));
        });
    }

    protected function makeTenancyMiddlewareHighestPriority()
    {
        $tenancyMiddleware = [
            // Even higher priority than the initialization middleware
            Middleware\PreventAccessFromCentralDomains::class,

            Middleware\InitializeTenancyByDomain::class,
            Middleware\InitializeTenancyBySubdomain::class,
            Middleware\InitializeTenancyByDomainOrSubdomain::class,
            Middleware\InitializeTenancyByPath::class,
            Middleware\InitializeTenancyByRequestData::class,
        ];

        foreach (array_reverse($tenancyMiddleware) as $middleware) {
            $this->app[\Illuminate\Contracts\Http\Kernel::class]->prependToMiddlewarePriority($middleware);
        }
    }
}
