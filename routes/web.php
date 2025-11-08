<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Http\Controllers\Front\Auth\RegisterController;
use App\Http\Controllers\Front\Auth\LoginController;
use App\Http\Controllers\Front\HomeController as FrontHomeController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\CategoryController;

use App\Http\Controllers\Admin\{
    TitleController,
    MedicineController, DiseaseController, ProceedureController,
    DivisionController, ChapterController, FormulationController,
    DivisionChapterController, DivisionProceedureController
};

use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\Admin\CustomerController;

use App\Http\Controllers\Admin\ActivityController;

use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ChangePasswordController;

use App\Http\Controllers\Admin\FeedbackController;

use App\Http\Controllers\Front\LanguageController as FrontLanguageController;

use App\Http\Controllers\Admin\ContentItemController;
// use App\Http\Controllers\Admin\AjaxController;

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

Route::get('/all_cache', function() {

    Artisan::call('cache:clear');
    Artisan::call('optimize');
    Artisan::call('route:cache');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    return '<h1>All cache cleared</h1>';
});

// Route::get('/', [HomeController::class, 'index'])->name('index');
// Route::get('/', [LoginController::class, 'showLoginForm'])->name('index');
Route::get('/', function () {
    return view('pages.home');
})->name('index');
Route::get('/test', [HomeController::class, 'test'])->name('test');

Route::group(['prefix'=>'sms', 'as'=>'sms.'], function() {
    Route::get('/open', [HomeController::class, 'sms'])->name('index');
    Route::post('/send', [HomeController::class, 'send'])->name('send');
});

Route::view('/access-denied', 'pages.unauthenticated')->name('unauthenticated.page');

Route::post('/get-districts', [FrontHomeController::class, 'getDistrictList'])->name('get.districts');

// Route::middleware(['auth:guest'])->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('front.register');
    Route::post('/register', [RegisterController::class, 'register'])->name('front.register.submit');

    Route::post('/check-customer', [RegisterController::class, 'checkCustomerExists'])->name('front.customer.exists');

    Route::post('/register/firebase', [RegisterController::class, 'registerWithFirebase'])->name('front.register.firebase');

    Route::get('/verify-otp', [RegisterController::class, 'showOtpForm'])->name('verify.otp.form');
    Route::post('/verify-otp', [RegisterController::class, 'verifyOtp'])->name('verify.otp');

    // Route::get('/login', [LoginController::class, 'showLoginForm']);
    Route::prefix('customer')->name('customer.')->group(function () {
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [LoginController::class, 'login'])->name('login.submit');
        Route::get('/login/otp', [LoginController::class, 'showOtpLoginForm'])->name('front.login.otp');
        Route::post('/login/otp/verify', [LoginController::class, 'verifyOtpLogin'])->name('front.login.otp.verify');

    });
// });

Route::get('language/{locale}', [FrontLanguageController::class, 'switch'])->name('front.set.language');


// ADMIN ROUTES START

Auth::routes(['login' => false, 'register'=>false, 'logout'=>false]);
Route::prefix('super/admin')->group(function () {
    Route::get('/login', [AdminLoginController::class,'showLoginForm'])->name('admin.show.login');
    Route::post('/login', [AdminLoginController::class,'login'])->name('login');
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');
});

Route::get('/super/admin', [AdminHomeController::class,'index'])->middleware('auth')->name('admin');
Route::prefix('super/admin')->middleware(['auth:web'])->group(function () {

    Route::resource('titles', TitleController::class, ['as' => 'admin']);
    Route::resource('medicines', MedicineController::class, ['as' => 'admin']);
    Route::resource('diseases', DiseaseController::class, ['as' => 'admin']);
    Route::resource('proceedures', ProceedureController::class, ['as' => 'admin']);

    Route::resource('divisions', DivisionController::class, ['as' => 'admin']);
    Route::resource('chapters', ChapterController::class, ['as' => 'admin']);
    Route::resource('formulations', FormulationController::class, ['as' => 'admin']);

    // CREATE content under a specific category
    Route::get('/content-items/{category_id}/specific', [ContentItemController::class, 'specific'])
        ->name('admin.specific.category');

    // EDIT content within that category context
    Route::get('/content-items/{category_id}/specific/{content_id}', [ContentItemController::class, 'specific_edit'])
        ->name('admin.specific.category.edit');

    // Standard resource routes (index, store, update, destroy)
    Route::resource('content-items', ContentItemController::class, ['as' => 'admin'])->except(['create', 'edit', 'show']);

    Route::get('ajax/category-fields/{id}', [ContentItemController::class, 'getCategoryFields'])
        ->name('admin.ajax.category-fields');

    Route::post('/content-items/{id}/toggle-status', [ContentItemController::class, 'toggleStatus'])
        ->name('admin.content-items.toggle-status');


    Route::get('division-chapters', [DivisionChapterController::class, 'index'])->name('admin.division.chapters.index');
    Route::post('division-chapters/attach', [DivisionChapterController::class, 'attach'])->name('admin.division.chapters.attach');
    Route::delete('division-chapters/{division}/{chapter}', [DivisionChapterController::class, 'detach'])->name('admin.division.chapters.detach');

    Route::get('division-proceedures', [DivisionProceedureController::class, 'index'])->name('admin.division.proceedures.index');
    Route::post('division-proceedures/attach', [DivisionProceedureController::class, 'attach'])->name('admin.division.proceedures.attach');
    Route::delete('division-proceedures/{division}/{proceedure}', [DivisionProceedureController::class, 'detach'])->name('admin.division.proceedures.detach');
});
Route::prefix('super/admin')->name('admin.')->middleware(['auth:web'])->group(function () {
    Route::get('/dashboard', [AdminHomeController::class,'index'])->name('dashboard');
    Route::post('/districts', [AdminHomeController::class,'distric_list'])->name('list.districts');

    Route::group(['prefix'=>'categories', 'as'=>'categories.', 'middleware' => ['role:Administrator|Manager']], function() {
        Route::get('/',[CategoryController::class,'index'])->name('index');
        Route::get('/create',[CategoryController::class,'create'])->name('create');
        Route::post('/store',[CategoryController::class,'store'])->name('store');
        Route::get('/edit/{id}',[CategoryController::class,'edit'])->name('edit');
        Route::put('/update',[CategoryController::class,'update'])->name('update');
        Route::delete('/destroy/{id}',[CategoryController::class,'destroy'])->name('destroy');
        Route::get('/change-status/{id}',[CategoryController::class,'changeStatus'])->name('changeStatus');
        Route::get('/products/{id}',[CategoryController::class,'products'])->name('products');
    });



    Route::middleware(['role:Administrator|Manager'])->group(function () {
        Route::resource('customers', CustomerController::class);
        Route::get('wallets', [CustomerController::class, 'wallets'])->name('customers.wallets');
        Route::get('wallets/status/{id}', [CustomerController::class, 'toggleWalletStatus'])->name('customers.wallets.toggleWalletStatus');
        Route::post('wallets/bulk-toggle', [CustomerController::class, 'bulkToggleWalletStatus'])->name('customers.wallets.bulkToggle');
        Route::get('customers/status/{id}', [CustomerController::class, 'changeStatus'])->name('customers.changeStatus');

        Route::get('addon-wallets', [CustomerController::class, 'addon_wallets'])->name('customers.addon.wallets');
        Route::get('addon-wallets/status/{id}', [CustomerController::class, 'toggleAddonWalletStatus'])->name('customers.addons.toggleWalletStatus');
        Route::post('addons/bulk-toggle', [CustomerController::class, 'bulkToggleAddonWalletStatus'])->name('customers.addons.bulkToggle');

        Route::get('customers/status/{id}', [CustomerController::class, 'changeStatus'])->name('customers.changeStatus');
        Route::get('customers/approve/{id}',[CustomerController::class,'approve'])->name('approve');
    });

    Route::prefix('feedbacks')->name('feedbacks.')->group(function () {
        Route::get('/', [FeedbackController::class, 'index'])->name('index');
        Route::get('/toggle/{id}', [FeedbackController::class, 'togglePublic'])->name('togglePublic');
        Route::post('/{feedback}/reply-ajax', [FeedbackController::class, 'replyAjax'])->name('reply.ajax');
    });

    Route::group(['prefix'=>'users', 'as'=>'users.', 'middleware' => ['role:Administrator']], function() {
        Route::get('/',[UserController::class,'index'])->name('index');
        Route::get('/create',[UserController::class,'create'])->name('create');
        Route::post('/store',[UserController::class,'store'])->name('store');
        Route::get('/edit/{id}',[UserController::class,'edit'])->name('edit');
        Route::put('/update',[UserController::class,'update'])->name('update');
        Route::delete('/destroy/{id}',[UserController::class,'destroy'])->name('destroy');
        Route::get('/change-status/{id}',[UserController::class,'changeStatus'])->name('changeStatus');
    });

    Route::group(['prefix'=>'settings', 'as'=>'settings.'], function() {
        Route::get('/',[SettingsController::class,'index'])->name('index');
        Route::put('/general',[SettingsController::class,'update'])->name('update.general');
        Route::get('/password/change',[ChangePasswordController::class,'edit'])->name('change.password');
        Route::put('/password/update',[ChangePasswordController::class,'update'])->name('update.password');
    });

    // Route::resource('/roles',RoleController::class)->middleware('role:Administrator');

    Route::group(['prefix'=>'activities', 'as'=>'activities.'], function() {
        Route::get('/',[ActivityController::class,'index'])->name('index');
    });
});
// Admin Dashboard Routes --End--


//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

// Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

//Update User Details
// Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
// Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

// Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index.home');

//Route::get('/test', [App\Http\Controllers\HomeController::class, 'test'])->name('test');


