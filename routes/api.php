<?php

use App\Http\Controllers\Alumni\OrderController;
use App\Http\Controllers\addon\saas\admin\OrderController as SubscriptionOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//call back
Route::match(array('GET', 'POST'), 'verify', [OrderController::class, 'verify'])->middleware([InitializeTenancyByDomain::class])->name('payment.verify');
Route::match(array('GET', 'POST'), 'subscription/verify', [SubscriptionOrder::class, 'verify'])->name('subscription.payment.verify');
