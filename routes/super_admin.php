<?php

use App\Http\Controllers\addon\saas\super_admin\CurrencyController;
use App\Http\Controllers\SuperAdmin\DashboardController;
use App\Http\Controllers\addon\saas\super_admin\EmailTemplateController;
use App\Http\Controllers\addon\saas\super_admin\GatewayController;
use App\Http\Controllers\SuperAdmin\AddonUpdateController;
use App\Http\Controllers\SuperAdmin\LanguageController;
use App\Http\Controllers\SuperAdmin\ProfileController;
use App\Http\Controllers\SuperAdmin\SettingController;
use App\Http\Controllers\SuperAdmin\VersionUpdateController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// all route start
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');



Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
    Route::get('/', [ProfileController::class, 'myProfile'])->name('index');
    Route::get('change-password', [ProfileController::class, 'changePassword'])->name('change-password');
    Route::post('change-password', [ProfileController::class, 'changePasswordUpdate'])->name('change-password.update');
    Route::post('update', [ProfileController::class, 'update'])->name('update')->middleware('isDemo');
});

Route::group(['prefix' => 'setting', 'as' => 'setting.'], function () {
    Route::get('application-settings', [SettingController::class, 'applicationSetting'])->name('application-settings');
    Route::get('configuration-settings', [SettingController::class, 'configurationSetting'])->name('configuration-settings');
    Route::get('configuration-settings/configure', [SettingController::class, 'configurationSettingConfigure'])->name('configuration-settings.configure');
    Route::get('configuration-settings/help', [SettingController::class, 'configurationSettingHelp'])->name('configuration-settings.help');
    Route::post('application-settings-update', [SettingController::class, 'applicationSettingUpdate'])->name('application-settings.update');
    Route::post('configuration-settings-update', [SettingController::class, 'configurationSettingUpdate'])->name('configuration-settings.update');
    Route::post('application-env-update', [SettingController::class, 'saveSetting'])->name('settings_env.update');
    Route::get('color-settings', [SettingController::class, 'colorSettings'])->name('color-settings');

    Route::get('storage-settings', [SettingController::class, 'storageSetting'])->name('storage.index');
    Route::post('storage-settings', [SettingController::class, 'storageSettingsUpdate'])->name('storage.update');
    Route::get('storage-link', [SettingController::class, 'storageLink'])->name('storage.link');

    Route::get('maintenance-mode-changes', [SettingController::class, 'maintenanceMode'])->name('maintenance');
    Route::post('maintenance-mode-changes', [SettingController::class, 'maintenanceModeChange'])->name('maintenance.change');

    Route::get('cache-settings', [SettingController::class, 'cacheSettings'])->name('cache-settings');
    Route::get('cache-update/{id}', [SettingController::class, 'cacheUpdate'])->name('cache-update');

    Route::get('mail-configuration', [SettingController::class, 'mailConfiguration'])->name('mail-configuration');
    Route::post('mail-configuration', [SettingController::class, 'mailConfiguration'])->name('mail-configuration');
    Route::post('mail-test', [SettingController::class, 'mailTest'])->name('mail.test');

    Route::get('sms-configuration', [SettingController::class, 'smsConfiguration'])->name('sms-configuration');
    Route::post('sms-configuration', [SettingController::class, 'smsConfigurationStore'])->name('sms-configuration');
    Route::post('sms-test', [SettingController::class, 'smsTest'])->name('sms.test');

    Route::post('common-settings-update', [SettingController::class, 'commonSettingUpdate'])->name('common.settings.update')->middleware('isDemo');

    Route::group(['prefix' => 'language', 'as' => 'languages.'], function () {
        Route::get('/', [LanguageController::class, 'index'])->name('index');
        Route::post('store', [LanguageController::class, 'store'])->name('store');
        Route::get('edit/{id}/{iso_code?}', [LanguageController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [LanguageController::class, 'update'])->name('update');
        Route::get('translate/{id}', [LanguageController::class, 'translateLanguage'])->name('translate');
        Route::post('update-translate/{id}', [LanguageController::class, 'updateTranslate'])->name('update.translate');
        Route::post('delete/{id}', [LanguageController::class, 'delete'])->name('delete');
        Route::post('update-language/{id}', [LanguageController::class, 'updateLanguage'])->name('update-language');
        Route::get('translate/{id}/{iso_code?}', [LanguageController::class, 'translateLanguage'])->name('translate');
        Route::get('update-translate/{id}', [LanguageController::class, 'updateTranslate'])->name('update.translate');
        Route::post('import', [LanguageController::class, 'import'])->name('import')->middleware('isDemo');
    });

    Route::group(['prefix' => 'currency', 'as' => 'currencies.'], function () {
        Route::get('', [CurrencyController::class, 'index'])->name('index');
        Route::post('currency', [CurrencyController::class, 'store'])->name('store');
        Route::get('edit/{id}', [CurrencyController::class, 'edit'])->name('edit');
        Route::patch('update/{id}', [CurrencyController::class, 'update'])->name('update');
        Route::post('delete/{id}', [CurrencyController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'gateway', 'as' => 'gateway.'], function () {
        Route::get('/', [GatewayController::class, 'index'])->name('index');
        Route::post('store', [GatewayController::class, 'store'])->name('store')->middleware('isDemo');
        Route::get('get-info', [GatewayController::class, 'getInfo'])->name('get.info');
        Route::get('get-currency-by-gateway', [GatewayController::class, 'getCurrencyByGateway'])->name('get.currency');
    });

    Route::get('email-template', [EmailTemplateController::class, 'emailTemplate'])->name('email-template');
    Route::get('email-template-config', [EmailTemplateController::class, 'emailTemplateConfig'])->name('email.template.config');
    Route::post('email-template-config-update', [EmailTemplateController::class, 'emailTemplateConfigUpdate'])->name('email.template.config.update');

    Route::get('custom-domain-details', [SettingController::class, 'customDomainDetails'])->name('custom-domain-details');

});
// all route end
