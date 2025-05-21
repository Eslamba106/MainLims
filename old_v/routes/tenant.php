<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use App\Http\Controllers\first_part\TestMethodController;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');
    Route::get('language/{locale}', function ($locale) {
        if (in_array($locale, ['en', 'ar'])) {
            Session::put('locale', $locale);
        }
        return redirect()->back();
    })->name('lang');
    Route::group(['prefix' => 'test_method'], function () {
        Route::get('/test_method', [TestMethodController::class, 'index'])->name('test_method.index');
        // Route::post('/test_method', [ TestMethodController::class, 'index'])->name('test_method.index');
    });
});
