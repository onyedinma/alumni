<?php

namespace App\Providers;

use App\Models\Language;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Stancl\Tenancy\Database\Models\Domain;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::defaultView('frontend.pagination.custom');
        try {
            $connection = DB::connection()->getPdo();
            if ($connection) {
                $allOptions = [];
                if(getAddonCodeBuildVersion('ALUSAAS')){
                    $host = request()->getHost();
                    $domain = Domain::where('domain', $host)->first();
                }else{
                    $domain = Domain::first();
                }

                $allOptions['settings'] = Setting::where('tenant_id', $domain->tenant_id ?? NULL)->get()->pluck('option_value', 'option_key')->toArray();
                $superAdminOptions['settings'] = Setting::where('tenant_id', NULL)->whereIn('option_key', superAdminSetting())->get()->pluck('option_value', 'option_key')->toArray();

                $allOptions['settings'] = array_merge($allOptions['settings'],$superAdminOptions['settings']);

                config($allOptions);

                $language = Language::where('iso_code', session()->get('local'))->first();

                if (!$language) {
                    $language = Language::find(1);
                    if ($language) {
                        $ln = $language->iso_code;
                        session(['local' => $ln]);
                        App::setLocale(session()->get('local'));
                    }
                } else {
                    $language = Language::where('default', ACTIVE)->first();
                    if ($language) {
                        $ln = $language->iso_code;
                        session(['local' => $ln]);
                        App::setLocale(session()->get('local'));
                    }
                }
                config(['app.defaultLanguage' => getDefaultLanguage()]);
                config(['app.currencySymbol' => getCurrencySymbol($domain->tenant_id ?? NULL)]);
                config(['app.isoCode' => getIsoCode($domain->tenant_id ?? NULL)]);
                config(['app.currencyPlacement' => getCurrencyPlacement($domain->tenant_id ?? NULL)]);
                config(['app.debug' => getOption('app_debug', true)]);
                config(['app.timezone' => getOption('app_timezone', 'UTC')]);

                config(['services.google.client_id' => getOption('google_client_id')]);
                config(['services.google.client_secret' => getOption('google_client_secret')]);
                config(['services.google.redirect' => url('auth/google/callback')]);

                config(['services.facebook.client_id' => getOption('facebook_client_id')]);
                config(['services.facebook.client_secret' => getOption('facebook_client_secret')]);
                config(['services.facebook.redirect' => url('auth/facebook/callback')]);
                if (!empty(getOption('google_recaptcha_status')) && getOption('google_recaptcha_status') == 1) {
                    config(['recaptchav3.sitekey' => getOption('google_recaptcha_site_key')]);
                    config(['recaptchav3.secret' => getOption('google_recaptcha_secret_key')]);
                }

                if (getOption('pusher_status', 0)) {
                    config(['broadcasting.connections.pusher.key' => getOption('pusher_app_key', 'null')]);
                    config(['broadcasting.connections.pusher.secret' => getOption('pusher_app_secret', 'null')]);
                    config(['broadcasting.connections.pusher.app_id' => getOption('pusher_app_id', 'null')]);
                    config(['broadcasting.connections.pusher.options.cluster' => getOption('pusher_cluster', 'null')]);
                    config(['broadcasting.default' => 'pusher']);
                } else {
                    config(['broadcasting.default' => 'null']);
                }

                date_default_timezone_set(getOption('app_timezone', 'UTC'));

            }
        } catch (\Exception $e) {
            Log::info('Service Provider - ' . $e->getMessage());
        }
    }
}
