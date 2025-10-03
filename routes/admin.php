<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\part\PlantController;
use App\Http\Controllers\Admin\SchemaController;
use App\Http\Controllers\Admin\TenantController;
use App\Http\Controllers\ConversationRequestController;

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
    
    Route::get("dashboard", function () {
        return view("admin.dashboard.index");
    })->name("admin.dashboard")->middleware('auth:admins');
    
    Route::get('language/{locale}', function ($locale) {
        if (in_array($locale, ['en', 'ar'])) {
            Session::put('locale', $locale);
        }
        return redirect()->back();
    })->name('admin.lang');
    Route::group(["prefix" => "tenant"], function () {
        Route::get("/", [TenantController::class, "index"])->name("admin.tenant_management")->middleware('auth:admins');
        Route::post("store_tenant", [TenantController::class, "store"])->name("admin.tenant_management.store_tenant")->middleware('auth:admins');
        Route::post("register_tenant", [TenantController::class, "register"])->name("admin.tenant_management.register_tenant");
        Route::get("create", [TenantController::class, "create"])->name("admin.tenant_management.create")->middleware('auth:admins');
        Route::get("edit/{id}", [TenantController::class, "edit"])->name("admin.tenant_management.edit")->middleware('auth:admins');
        Route::post("update/{id}", [TenantController::class, "update"])->name("admin.tenant_management.update")->middleware('auth:admins');
        Route::get("delete", [TenantController::class, "delete"])->name("admin.tenant_management.delete")->middleware('auth:admins');
    });
    Route::group(["prefix" => "plans"], function () {
        Route::get("/", [SchemaController::class, "list"])->name("admin.schema")->middleware('auth:admins');
        Route::get("/create", [SchemaController::class, "create"])->name("admin.schema.create")->middleware('auth:admins');
        Route::post("/store", [SchemaController::class, "store"])->name("admin.schema.store")->middleware('auth:admins');
        Route::get("/edit/{id}", [SchemaController::class, "edit"])->name("admin.schema.edit")->middleware('auth:admins');
        Route::patch("/update/{id}", [SchemaController::class, "update"])->name("admin.schema.update")->middleware('auth:admins');
    });
    Route::group(["prefix" => "conversation-requests"], function () {
        Route::get("/", [ConversationRequestController::class, "list"])->name("admin.conversation_requests")->middleware('auth:admins'); 
        Route::get("/delete/{id}", [ConversationRequestController::class, "delete"])->name("admin.conversation_requests.delete")->middleware('auth:admins'); 
    });
});
