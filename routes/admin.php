<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Admin panel Routes
|--------------------------------------------------------------------------
|
*/

Route::prefix('admin')->group(function() {
    Auth::routes();
    Route::group(['middleware' => ['auth']], function() {
        Route::resource('roles','Admin\RoleController');
        Route::resource('users','Admin\UserController');
        Route::get('users_destroy_delete/{id}','Admin\UserController@user_delete')->name('users.destroy_delete');
        Route::resource('products','Admin\ProductController');

        Route::get('dashboard', 'Admin\DashboardController@index')->name('dashboard');
        Route::get('vendors_show', 'Admin\DashboardController@vendors_show')->name('vendors_show');
        Route::get('patient_show', 'Admin\DashboardController@patient_show')->name('patient_show');
        Route::get('themes', 'Admin\DashboardController@themes')->name('themes');
        Route::post('admin_theme_change','Admin\DashboardController@admin_theme_change')->name('admin_theme_change');
        Route::post('laboratory_theme_change','Admin\DashboardController@laboratory_theme_change')->name('laboratory_theme_change');
        Route::get('branches', 'Admin\DashboardController@branches')->name('Aggregate_Data.branches');
        Route::get('agregate_data','Admin\DashboardController@agregateData')->name('aggregate_data');
        Route::post('agregate_data_filter','Admin\DashboardController@agregateDataFilter')->name('agregateData.filterReports');
        Route::post('branches','Admin\DashboardController@get_branches')->name('get_branches');
        Route::get('agregate_reports/{id}','Admin\DashboardController@patient_report')->name('agregate_reports');
        Route::get('patient/{id}','Admin\DashboardController@agergate_data_patient')->name('agergate_data_patient');



        Route::resource('shop', 'Admin\ShopController');
        Route::resource('article', 'Admin\ArticleController');
        Route::resource('category', 'Admin\CategoryController');
        Route::post('get_states',[UserController::class, 'get_states'])->name('get_states');
        Route::post('get_country',[UserController::class, 'get_country'])->name('get_country');
    });
});

