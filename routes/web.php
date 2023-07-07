<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\SuperAdmin\RolesController;
use App\Http\Controllers\backend\SuperAdmin\MainCategoryController;
use App\Http\Controllers\backend\SuperAdmin\SubCategoryController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Backend Routes

// Super Admin Routes
Route::group(['namespace' => 'Backend','prefix' => 'administrator', 'middleware' => ['auth', 'role:super-admin|admin']], function() {
    // Dashboard routes
    Route::get('/', function () {
        return redirect()->route('super_admin_dashboard');
    });

    Route::get('dashboard', [DashboardController::class,'index'])->name('super_admin_dashboard');

    // Roles management routes
    Route::get('roles-management', [RolesController::class,'index'])->name('backend_roles');
    Route::get('create-role', [RolesController::class,'create'])->name('backend_create_role');
    Route::post('create-role', [RolesController::class,'store'])->name('backend_store_role');
    Route::get('edit-role/{edit_id}', [RolesController::class,'edit'])->name('backend_edit_role');
    Route::post('update-role/{update_id}', [RolesController::class,'update'])->name('backend_update_role');
    Route::post('delete-role/{delete_id}',[RolesController::class,'destroy'])->name('backend_delete_role');

    // User management routes
    Route::get('users-management', [UserController::class,'index'])->name('backend_all_users');
    Route::get('create-user', [UserController::class,'create'])->name('backend_create_user');
    Route::post('create-user', [UserController::class,'store'])->name('backend_store_user');
    Route::post('delete-user/{delete_id}', [UserController::class,'destroy'])->name('backend_destroy_user');
    // Route::get('edit-user/{edit_id}', [UserController::class,'edit'])->name('backend_edit_user');
    Route::group(['namespace' => 'Backend','prefix' => 'edit-user'], function(){
        Route::get('account/{edit_id}', [UserController::class,'edit'])->name('backend_edit_user_account');
        Route::post('update-account/{update_id}', [UserController::class,'update'])->name('backend_update_user_account');

        Route::get('security/{edit_id}', [UserController::class,'edit'])->name('backend_edit_user_security');
        Route::post('update-security/{update_id}', [UserController::class,'update'])->name('backend_update_user_security');

        Route::get('billings-plans/{edit_id}', [UserController::class,'edit'])->name('backend_edit_user_billings_plans');

        Route::get('preferences/{edit_id}', [UserController::class,'edit'])->name('backend_edit_user_preferances');
        Route::post('update-preference/{update_id}', [UserController::class,'update'])->name('backend_update_user_preferences');

        Route::get('suspend/{suspend_id}', [UserController::class,'userSuspendRise'])->name('backend_suspend_user');
        Route::get('rise/{rise_id}', [UserController::class,'userSuspendRise'])->name('backend_rise_user');
    });

    // Main category management
    Route::get('main-categories', [MainCategoryController::class,'index'])->name('backend_all_main_categories');
    Route::get('create-main-category', [MainCategoryController::class,'create'])->name('backend_create_main_category');
    Route::post('create-main-category-slug', [MainCategoryController::class,'createCatSlug'])->name('backend_create_main_category_slug');
    Route::post('create-main-category', [MainCategoryController::class,'store'])->name('backend_store_main_category');
    Route::get('edit-main-category/{edit_id}', [MainCategoryController::class,'edit'])->name('backend_edit_main_category');
    Route::post('update-main-category/{update_id}', [MainCategoryController::class,'update'])->name('backend_update_main_category');
    Route::post('delete-main-category/{delete_id}', [MainCategoryController::class,'destroy'])->name('backend_delete_main_category');

    // Sub category management
    Route::get('sub-categories', [SubCategoryController::class,'index'])->name('backend_all_sub_categories');
    Route::get('create-sub-category', [SubCategoryController::class,'create'])->name('backend_create_sub_category');
    Route::post('create-sub-category-slug', [SubCategoryController::class,'createCatSlug'])->name('backend_create_sub_category_slug');
    Route::post('create-sub-category', [SubCategoryController::class,'store'])->name('backend_store_sub_category');
    Route::get('edit-sub-category/{edit_id}', [SubCategoryController::class,'edit'])->name('backend_edit_sub_category');
    Route::post('update-sub-category/{update_id}', [SubCategoryController::class,'update'])->name('backend_update_sub_category');
    Route::post('delete-sub-category/{delete_id}', [SubCategoryController::class,'destroy'])->name('backend_delete_sub_category');
});

// Admin Route
// Route::group(['namespace' => 'Backend','prefix' => 'dmh-admin', 'middleware' => ['auth', 'role:admin']], function() {
//     Route::get('/', function () {
//         return redirect()->route('dmh_admin_dashboard');
//     });

//     Route::get('dashboard', [DashboardController::class,'index'])->name('dmh_admin_dashboard');

//     // User management routes
//     Route::get('users-management', [UserController::class,'index'])->name('backend_all_users');
//     Route::get('create-user', [UserController::class,'create'])->name('backend_create_user');
//     Route::post('create-user', [UserController::class,'store'])->name('backend_store_user');
//     // Route::get('edit-user/{edit_id}', [UserController::class,'edit'])->name('backend_edit_user');
//     Route::group(['namespace' => 'Backend','prefix' => 'edit-user'], function(){
//         Route::get('account/{edit_id}', [UserController::class,'edit'])->name('backend_edit_user_account');
//         Route::post('update-account/{update_id}', [UserController::class,'update'])->name('backend_update_user_account');

//         Route::get('security/{edit_id}', [UserController::class,'edit'])->name('backend_edit_user_security');
//         Route::post('update-security/{update_id}', [UserController::class,'update'])->name('backend_update_user_security');

//         Route::get('billings-plans/{edit_id}', [UserController::class,'edit'])->name('backend_edit_user_billings_plans');
//         Route::get('preferences/{edit_id}', [UserController::class,'edit'])->name('backend_edit_user_preferances');

//         Route::get('suspend/{suspend_id}', [UserController::class,'userSuspendRise'])->name('backend_suspend_user');
//         Route::get('rise/{rise_id}', [UserController::class,'userSuspendRise'])->name('backend_rise_user');
//     });
// });
