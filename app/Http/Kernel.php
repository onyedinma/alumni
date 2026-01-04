<?php

namespace App\Http;

use App\Http\Middleware\AddonMiddleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CommonMiddleware;
use App\Http\Middleware\Google2FAAuthentication;
use App\Http\Middleware\GoogleAuthentication;
use App\Http\Middleware\InstallMiddleware;
use App\Http\Middleware\IsDemo;
use App\Http\Middleware\IsVerifyMiddleware;
use App\Http\Middleware\SubscriptionMiddleware;
use App\Http\Middleware\SuperAdminMiddleware;
use App\Http\Middleware\TenancyMiddleware;
use App\Http\Middleware\UserMiddleware;
use App\Http\Middleware\VersionUpdate;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\LastUserActivity::class,
        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
        'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
        'role_or_permission' => \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class,
        'admin' => AdminMiddleware::class,
        'super-admin' => SuperAdminMiddleware::class,
        'user' => UserMiddleware::class,
        'version.update' => VersionUpdate::class,
        'installed' => InstallMiddleware::class,
        'isDemo' => IsDemo::class,
        '2fa_verify' => Google2FAAuthentication::class,
        'is_email_verify' => IsVerifyMiddleware::class,
        'common' => CommonMiddleware::class,
        'addon' => AddonMiddleware::class,
        'tenancy' => TenancyMiddleware::class,
        'subscription' => SubscriptionMiddleware::class,
    ];
}
