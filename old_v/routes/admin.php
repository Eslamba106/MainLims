<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;  
use App\Http\Controllers\admin\TenantController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(["prefix" => "auth/admin"], function () {
    Route::post("login", [AuthController::class, "admin_login"])->name("admin.login")->withoutMiddleware('auth');
    Route::get("logout", [AuthController::class, "admin_logout"])->name("admin.logout")->middleware('auth:admins');
});
Route::group(["prefix" => "admin"], function () {
    Route::get("dashboard", function(){
        return view("dashboard.index");
    })->name("admin.dashboard")->middleware('auth:admins');
    Route::get('language/{locale}', function ($locale) {
        if (in_array($locale, ['en', 'ar'])) {
            Session::put('locale', $locale);
        }
        return redirect()->back();
    })->name('admin.lang');
    Route::group(["prefix" => "tenant"], function () {
        Route::get("/", [TenantController::class, "index"])->name("admin.tenant_management")->middleware('auth:admins');
        Route::get("create", [TenantController::class, "create"])->name("admin.tenant_management.create")->middleware('auth:admins');
        Route::post("store", [TenantController::class, "store"])->name("admin.tenant_management.store")->middleware('auth:admins');
     });
});