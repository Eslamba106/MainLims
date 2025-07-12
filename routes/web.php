<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\part\PlantController;
use App\Http\Controllers\part\SampleController;
use App\Http\Controllers\part\GeneralController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\part_three\ResultController;
use App\Http\Controllers\Admin\UserManagmentController;
use App\Http\Controllers\first_part\TestMethodController;
use App\Http\Controllers\part_three\COATemplateController;
use App\Http\Controllers\second_part\SubmissionController;
use App\Http\Controllers\second_part\SampleRoutineSchedulerController;

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


Route::get('/', function () {
    return view('auth.login-page');
})->name('login-page');


Route::get('/login', function () {
    return view('first_part.auth.login-page');
})->name('web.login-page');

// Route::get('/', [AuthController::class, 'loginPage'])->name('login-page');
// // Translation

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login_tenancy', [AuthController::class, 'login_tenancy'])->name('login_tenancy');
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
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


// Test Method Managment
Route::group(['prefix' => 'test_method'], function () {

    Route::get('/', [TestMethodController::class, 'index'])->name('admin.test_method');
    Route::get('/create', [TestMethodController::class, 'create'])->name('admin.test_method.create');
    Route::post('/create', [TestMethodController::class, 'store'])->name('admin.test_method.store');
    Route::get('/edit/{id}', [TestMethodController::class, 'edit'])->name('admin.test_method.edit');
    Route::patch('/update/{id}', [TestMethodController::class, 'update'])->name('admin.test_method.update');
    Route::get('/delete/{id}', [TestMethodController::class, 'destroy'])->name('admin.test_method.delete');
    Route::get('/delete_component/{id}', [TestMethodController::class, 'delete_component'])->name('admin.test_method.delete_component');
});

// Sample Managment
Route::group(['prefix' => 'sample'], function () {

    Route::get('/', [SampleController::class, 'index'])->name('admin.sample');
    Route::get('/create', [SampleController::class, 'create'])->name('admin.sample.create');
    Route::post('/store', [SampleController::class, 'store'])->name('admin.sample.store');
    Route::get('/edit/{id}', [SampleController::class, 'edit'])->name('admin.sample.edit');
    Route::patch('/update/{id}', [SampleController::class, 'update'])->name('admin.sample.update');
    Route::get('/delete/{id}', [SampleController::class, 'destroy'])->name('admin.sample.delete');
    Route::get('/get_sub_from_plant/{id}', [SampleController::class, 'get_sub_from_plant'])->name('admin.sample.get_sub_from_plant');
    Route::get('/get_sample_from_plant/{id}', [SampleController::class, 'get_sample_from_plant'])->name('admin.sample.get_sample_from_plant');
    Route::get('/get_components_by_test_method/{id}', [SampleController::class, 'get_components_by_test_method'])->name('admin.sample.get_components_by_test_method');
    Route::get('/get_one_component_by_test_method/{id}', [SampleController::class, 'get_one_component_by_test_method'])->name('admin.sample.get_one_component_by_test_method');
});
// Submission Managment
Route::group(['prefix' => 'submission'], function () {

    Route::get('/', [SubmissionController::class, 'index'])->name('admin.submission');
    Route::get('/create', [SubmissionController::class, 'create'])->name('admin.submission.create');
    Route::post('/create', [SubmissionController::class, 'store'])->name('admin.submission.store');
    Route::get('/edit/{id}', [SubmissionController::class, 'edit'])->name('admin.submission.edit');
    Route::patch('/update/{id}', [SubmissionController::class, 'update'])->name('admin.submission.update');
    Route::get('/delete/{id}', [SubmissionController::class, 'destroy'])->name('admin.submission.delete');
    Route::get('/get_sub_from_plant/{id}', [SubmissionController::class, 'get_sub_from_plant'])->name('admin.submission.get_sub_from_plant');
    Route::get('/get_sample_from_plant/{id}', [SubmissionController::class, 'get_sample_from_plant'])->name('admin.submission.get_sample_from_plant');
    Route::get('/get_test_method_by_sample_id/{id}', [SubmissionController::class, 'get_test_method_by_sample_id'])->name('admin.submission.get_test_method_by_sample_id');

    // schedule
    Route::get('/schedule', [SampleRoutineSchedulerController::class, 'index'])->name('admin.submission.schedule');
    Route::get('/schedule/create', [SampleRoutineSchedulerController::class, 'create'])->name('admin.submission.schedule.create');
    Route::post('/schedule/create', [SampleRoutineSchedulerController::class, 'store'])->name('admin.submission.schedule.store');
    Route::get('/schedule/get_sample_by_plant_id/{id}', [SampleRoutineSchedulerController::class, 'get_sample_by_plant_id'])->name('admin.submission.schedule.get_sample_by_plant_id');
});

// Result Management
Route::group(['prefix' => 'results'], function () {

    Route::get('/', [ResultController::class, 'index'])->name('admin.result');
    Route::get('/create/{id}/{slug}', [ResultController::class, 'create'])->name('admin.result.create');
    Route::post('/create', [ResultController::class, 'store'])->name('admin.result.store');
    Route::get('/edit/{id}', [ResultController::class, 'edit'])->name('admin.result.edit');
    Route::patch('/update/{id}', [ResultController::class, 'update'])->name('admin.result.update');
    Route::get('/delete/{id}', [ResultController::class, 'destroy'])->name('admin.result.delete');
    Route::get('/confirm_results/{id}', [ResultController::class, 'confirm_results'])->name('admin.result.confirm_results');
    Route::get('/approve_confirm_results/{id}', [ResultController::class, 'approve_confirm_results'])->name('admin.result.approve_confirm_results');
    Route::get('/cancel_confirm_results/{id}', [ResultController::class, 'cancel_confirm_results'])->name('admin.result.cancel_confirm_results');
    Route::get('/approve_confirm_results_by_item/{id}', [ResultController::class, 'approve_confirm_results_by_item'])->name('admin.result.approve_confirm_results_by_item');
    Route::get('/cancel_confirm_results_by_item/{id}', [ResultController::class, 'cancel_confirm_results_by_item'])->name('admin.result.cancel_confirm_results_by_item');
});

// CAO Management
Route::group(['prefix' => 'cao'], function () {

    Route::get('/', [COATemplateController::class, 'template_designer'])->name('admin.template_designer');
    Route::post('/coa_settings', [COATemplateController::class, 'coa_settings'])->name('coa_settings.store');
    Route::get('update-default-status', [COATemplateController::class, 'update_default_status'])->name('coa_settings.update-default-status');
    Route::get('edit/{id}', [COATemplateController::class, 'add_template_designer'])->name('coa_settings.edit');
});

// Unit Managment
Route::group(['prefix' => 'unit'], function () {

    Route::get('/', [GeneralController::class, 'unit_index'])->name('admin.unit');
    Route::get('/create', [GeneralController::class, 'unit_create'])->name('admin.unit.create');
    Route::post('/create', [GeneralController::class, 'unit_store'])->name('admin.unit.store');
    Route::get('/edit/{id}', [GeneralController::class, 'unit_edit'])->name('admin.unit.edit');
    Route::patch('/update/{id}', [GeneralController::class, 'unit_update'])->name('admin.unit.update');
    Route::get('/delete/{id}', [GeneralController::class, 'unit_destroy'])->name('admin.unit.delete');
});
// Unit Managment
Route::group(['prefix' => 'toxic_degree'], function () {

    Route::get('/', [GeneralController::class, 'toxic_degree_index'])->name('admin.toxic_degree');
    Route::get('/create', [GeneralController::class, 'toxic_degree_create'])->name('admin.toxic_degree.create');
    Route::post('/create', [GeneralController::class, 'toxic_degree_store'])->name('admin.toxic_degree.store');
    Route::get('/edit/{id}', [GeneralController::class, 'toxic_degree_edit'])->name('admin.toxic_degree.edit');
    Route::patch('/update/{id}', [GeneralController::class, 'toxic_degree_update'])->name('admin.toxic_degree.update');
    Route::get('/delete/{id}', [GeneralController::class, 'toxic_degree_destroy'])->name('admin.toxic_degree.delete');
});
// Frequency Managment
Route::group(['prefix' => 'frequency'], function () {

    Route::get('/', [GeneralController::class, 'frequency_index'])->name('admin.frequency');
    Route::get('/create', [GeneralController::class, 'frequency_create'])->name('admin.frequency.create');
    Route::post('/create', [GeneralController::class, 'frequency_store'])->name('admin.frequency.store');
    Route::get('/edit/{id}', [GeneralController::class, 'frequency_edit'])->name('admin.frequency.edit');
    Route::patch('/update/{id}', [GeneralController::class, 'frequency_update'])->name('admin.frequency.update');
    Route::get('/delete/{id}', [GeneralController::class, 'frequency_destroy'])->name('admin.frequency.delete');
});

// Result Type Managment
Route::group(['prefix' => 'result_type'], function () {

    Route::get('/result-type', [GeneralController::class, 'result_type_index'])->name('admin.result_type');
    Route::get('/create', [GeneralController::class, 'result_type_create'])->name('admin.result_type.create');
    Route::post('/create', [GeneralController::class, 'result_type_store'])->name('admin.result_type.store');
    Route::get('/edit/{id}', [GeneralController::class, 'result_type_edit'])->name('admin.result_type.edit');
    Route::patch('/update/{id}', [GeneralController::class, 'result_type_update'])->name('admin.result_type.update');
    Route::get('/delete/{id}', [GeneralController::class, 'result_type_destroy'])->name('admin.result_type.delete');
});
// Plant Managment
Route::group(['prefix' => 'plant'], function () {

    Route::get('/', [PlantController::class, 'plant_index'])->name('admin.plant');
    Route::get('/create', [PlantController::class, 'plant_create'])->name('admin.plant.create');
    Route::post('/create', [PlantController::class, 'plant_store'])->name('admin.plant.store');
    Route::get('/edit/{id}', [PlantController::class, 'plant_edit'])->name('admin.plant.edit');
    Route::patch('/update/{id}', [PlantController::class, 'plant_update'])->name('admin.plant.update');
    Route::get('/delete/{id}', [PlantController::class, 'plant_destroy'])->name('admin.plant.delete');
    Route::get('/delete_sample_from_plant/{id}', [PlantController::class, 'delete_sample_from_plant'])->name('plant.delete_sample_from_plant');
    Route::get('/delete_sub_plant_from_plant/{id}', [PlantController::class, 'delete_sub_plant_from_plant'])->name('plant.delete_sub_plant_from_plant');
    Route::get('/get_sub_plants', [PlantController::class, 'get_sub_plants'])->name('admin.plant.get_sub_plants');
});
// Sample Master Managment
Route::group(['prefix' => 'master_sample'], function () {

    Route::get('/', [PlantController::class, 'master_sample_index'])->name('admin.master_sample');
    Route::get('/create', [PlantController::class, 'master_sample_create'])->name('admin.master_sample.create');
    Route::post('/create', [PlantController::class, 'master_sample_store'])->name('admin.master_sample.store');
    Route::get('/edit/{id}', [PlantController::class, 'master_sample_edit'])->name('admin.master_sample.edit');
    Route::patch('/update/{id}', [PlantController::class, 'master_sample_update'])->name('admin.master_sample.update');
    Route::get('/delete/{id}', [PlantController::class, 'master_sample_destroy'])->name('admin.master_sample.delete');
    Route::get('/delete_sample_from_master_sample/{id}', [PlantController::class, 'delete_sample_from_master_sample'])->name('master_sample.delete_sample_from_master_sample');
    Route::get('/delete_sub_master_sample_from_master_sample/{id}', [PlantController::class, 'delete_sub_master_sample_from_master_sample'])->name('master_sample.delete_sub_master_sample_from_plant');
});


// User Managment
Route::group(['prefix' => 'user_management'], function () {

    Route::get('/', [UserManagmentController::class, 'index'])->name('user_managment');
    Route::get('/create', [UserManagmentController::class, 'create'])->name('user_managment.create');
    Route::post('/create', [UserManagmentController::class, 'store'])->name('user_managment.store');
    Route::get('/edit/{id}', [UserManagmentController::class, 'edit'])->name('user_managment.edit');
    Route::patch('/update/{id}', [UserManagmentController::class, 'update'])->name('user_managment.update');
    Route::get('/delete/{id}', [UserManagmentController::class, 'destroy'])->name('user_managment.delete');
});

Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
    Route::get('view',  [ProfileController::class, 'view'])->name('view');
    Route::get('update/{id}',  [ProfileController::class, 'edit'])->name('update');
    Route::post('update/{id}',  [ProfileController::class, 'update']);
    Route::post('settings-password', [ProfileController::class, 'settings_password_update'])->name('settings-password');

    Route::get('bank-edit/{id}',  [ProfileController::class, 'bank_edit'])->name('bankInfo');
    Route::post('bank-update/{id}',  [ProfileController::class, 'bank_update'])->name('bank_update');
});

Route::group(['prefix' => 'language', 'as' => 'language.'], function () {
    Route::get('', [LanguageController::class, 'index'])->name('index');
    Route::post('add-new', [LanguageController::class, 'store'])->name('add-new');
    Route::get('update-status', [LanguageController::class, 'update_status'])->name('update-status');
    Route::get('update-default-status', [LanguageController::class, 'update_default_status'])->name('update-default-status');
    Route::post('update', [LanguageController::class, 'update'])->name('update');
    Route::get('translate/{lang}', [LanguageController::class, 'translate'])->name('translate');
    Route::get('translate-list/{lang}', [LanguageController::class, 'translate_list'])->name('translate.list');
    Route::post('translate-submit/{lang}', [LanguageController::class, 'translate_submit'])->name('translate-submit');
    Route::post('remove-key/{lang}', [LanguageController::class, 'translate_key_remove'])->name('remove-key');
    Route::get('delete/{lang}', [LanguageController::class, 'delete'])->name('delete');
    Route::any('auto-translate/{lang}', [LanguageController::class, 'auto_translate'])->name('auto-translate');
});
// Roles
Route::group(['prefix' => 'admin/roles'], function () {
    Route::get('/', [RoleController::class, 'index'])->name('roles');
    Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/store', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('/{id}/update', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/delete', [RoleController::class, 'destroy'])->name('roles.delete');
});
