<?php

use App\ChangeTheme;
use App\Http\Controllers\AdditionalReportController;
use App\Http\Controllers\Admin\ChangeStatusController;
use App\Http\Controllers\ChangeThemeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\User\BranchAdditionalReport;
use App\Http\Controllers\Vendor\BranchController;
use App\Http\Controllers\Vendor\DashboardController;
use App\Http\Controllers\Vendor\VendorProfileController;
use App\Http\Controllers\Vendor\VendorUserController;
use App\Http\Controllers\Vendor\ExpensiveReportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserLoginController;
use App\Http\Controllers\User\BranchExpensiveReportController;
use App\Http\Controllers\Vendor\ProfitReportController;
use App\Http\Controllers\User\BranchProfitController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\BranchPathController;
use App\Http\Controllers\User\UserDashboard;
use App\Http\Controllers\Vendor\AddTestController;
use App\Http\Controllers\User\BranchAddTestController;
use App\Http\Controllers\User\BranchPermissionController;
use App\Http\Controllers\User\InvoiceController;
use App\Http\Controllers\User\PatientController as UserPatientController;
use App\Http\Controllers\Vendor\PatientController;
use App\Http\Controllers\User\PatientReportController;
use App\Http\Controllers\User\TestGigController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Vendor\AddTestReportController;
use App\Http\Controllers\Vendor\RolesPermissionController;
use App\Http\Controllers\Vendor\VendorAddReport;
use FontLib\Table\Type\name;
use App\Http\Controllers\Vendor\BarCodeController;

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

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/{slug}/{test}', [LoginController::class, 'test'])->name('test');
require __DIR__ . '/admin.php';
Route::group(['middleware' => ['auth']], function () {

    Route::post('vendor_change_status', [ChangeStatusController::class, 'vendor_change_status'])->name('vendor_change_status');
    // vendor routes
    Route::get('vendor_profile', [VendorProfileController::class, 'edit'])->name('vendor_profile.edit');
    Route::post('vendor_profile_update/{id}', [VendorProfileController::class, 'vendor_profile_update'])->name('vendor_profile_update');
    Route::resource('branch', 'Vendor\BranchController');
    Route::get('branch_destroy_delete/{id}',[BranchController::class, 'branch_destroy_delete'])->name('branch.destroy_delete');
    Route::post('branch_store', [BranchController::class, 'storeBranch'])->name('branch.storeBranch');
    Route::post('branch_change_status', [BranchController::class, 'branch_change_status'])->name('branch_change_status');
    Route::resource('branch_role', 'Vendor\VendorBranchRoleController');
    Route::resource('vendor_user', 'Vendor\VendorUserController');

    Route::get('vendor_user_deletes/{id}','Vendor\VendorUserController@vendor_user_destroy_delete')->name('vendor_user.destroy_delete');
    Route::post('get_vendor_branch_role', [VendorUserController::class, 'get_vendor_branch_role'])->name('get_vendor_branch_role');

    // roles and permisiion
    Route::resource('role_permission', 'Vendor\RolesPermissionController');
    Route::get('role_permission_delete/{id}',[RolesPermissionController::class, 'role_permission_delete'])->name('role_permission.destroy_delete');
    Route::get('dahboard', [LoginController::class, 'dashboard_view'])->name('dashboard_view');
    Route::post('vendor_login', [LoginController::class, 'vendor_login'])->name('vendor_login');
    Route::get('vendor_dashboard', [DashboardController::class, 'vendor_dashboard'])->name('vendor_dashboard');
    Route::get('employees', [DashboardController::class, 'employees'])->name('employees.show');
    Route::resource('patient', 'Vendor\PatientController');
    Route::get('patient_destroy_delete/{id}','Vendor\PatientController@patient_destroy_delete')->name('patient_destroy_delete');
    Route::post('patient_store_invoice',[PatientController::class, 'patient_store_invoice'])->name('patient.store_create_invoice');
    Route::post('patient_filter', [PatientController::class, 'patient_filter'])->name('patient_filter.filter_patient');
    Route::get('vendor_patient_inner/{id}', [PatientController::class, 'vendor_patient_inner'])->name('vendor_patient_inner');
    Route::post('vendor_patient_searches',[PatientController::class, 'vendor_patient_search'])->name('vendor_patient_searches');
    Route::resource('test_gig', 'TestGigController');
    Route::get('test_gig_delete/{id}','TestGigController@test_gig_delete')->name('test_gig.destroy_delete');
    Route::resource('epensive_report', 'Vendor\ExpensiveReportController');
    Route::get('epensive_report_delete/{id}',[ExpensiveReportController::class, 'epensive_report_delete'])->name('epensive_report.destroy_delete');
    Route::resource('profit_report', 'Vendor\ProfitReportController');
    Route::get('profit_report_delete/{id}',[ProfitReportController::class, 'profit_report_delete'])->name('profit_report.destroy_delete');
    Route::resource('test_report', 'Vendor\AddTestReportController');
    Route::get('test_report_delete/{id}',[AddTestReportController::class, 'test_report_delete'])->name('test_report.destroy_delete');

    Route::resource('add_test', 'Vendor\AddTestController');
    Route::get('add_test_delete/{id}',[AddTestController::class, 'add_test_destroy_delete'])->name('add_test.destroy_delete');
    Route::get("vendor_patient_search", [AddTestController::class, 'search_patient'])->name('vendor_search_patient');
    Route::get("vendor_add_gig_to_invoice", [AddTestController::class, 'vendor_add_gig_to_invoice'])->name('vendor_add_gig_to_invoice');
    Route::post('add_test_payement', [AddTestController::class, 'add_test_payemnet'])->name('add_testPayement');
    Route::post("payement_submit", [AddTestController::class, 'payement_submit'])->name('payement_submit');

    Route::post('patient_add_test',[PatientController::class, 'patient_add_test'])->name('patient_add_test.store_add_test');
    Route::post('patient_add_test_payement',[PatientController::class, 'patient_add_test_payement'])->name('patient_add_test_payement');
    Route::post('patient_payement_submit',[PatientController::class, 'patient_payement_submit'])->name('patient_payement_submit');

    Route::post('add_test_invoice', [AddTestController::class, 'create_invoice'])->name('add_test.invoice');
    Route::post('add_test_gig_amount', [AddTestController::class, 'add_test_gig_amount'])->name('add_test_gig_amount');
    Route::post('edit_test_invoice', [AddTestController::class, 'edit_invoice'])->name('edit_test.edit_invoice');
    Route::post('edit_test', [AddTestController::class, 'edit_test_store'])->name('edit_test.edit_test_store');
    Route::post('edit_test_payement', [AddTestController::class, 'edit_test_payement'])->name('edit_add_testPayement');
    Route::post("edit_payement_submit", [AddTestController::class, 'edit_payement_submit'])->name('edit_payement_submit');
    Route::get('edit_test_delete/{id}', [AddTestController::class, 'edit_test_delete'])->name('edit_test_delete');

    Route::post('epensive_report_filter', [ExpensiveReportController::class, 'filterReports'])->name('epensive_report.filterReports');
    Route::post('profit_report_filter', [ProfitReportController::class, 'profit_report_filter'])->name('profit_report.filterReports');
    Route::post('user_logout', [LoginController::class, 'user_logout'])->name('user_logout');
    Route::resource('vendor_add_report','Vendor\VendorAddReport');
    Route::get('vendor_add_report_delete/{id}',[VendorAddReport::class, 'vendor_add_report_destroy_delete'])->name('vendor_add_report.destroy_delete');
    Route::resource('vendor_theme_change','ThemeChangeController');
    Route::post('vendor_change_theme',[ChangeThemeController::class, 'vendor_change_theme'])->name('vendor_change_theme');
    Route::post('branch_theme_change',[ChangeThemeController::class, 'branch_theme_change'])->name('branch_theme_change');
    Route::resource('additional_report','AdditionalReportController');
    Route::get('additional_report_delete/{id}',[AdditionalReportController::class, 'delete'])->name('additional_report.destroy_delete');
    Route::post('vendor_bar_code_details',[BarCodeController::class, 'vendor_bar_code_details'])->name('vendor_bar_code_details');
    // ali excel route
    Route::get('export_report', [ExpensiveReportController::class, 'export'])->name('export_report');
    Route::get('export_profit', [ProfitReportController::class, 'export'])->name('export_profit');

    // Branch routes started
    Route::get('user-dashboard', [UserDashboard::class, 'user_dashboard'])->name('user_dashboard');
    Route::resource('user_profile', 'User\UserProfileController');
    Route::resource('branch_user', 'User\UserController');
    Route::get('branch_user_delete/{id}',[UserController::class, 'branch_user_destroy_delete'])->name('branch_user.destroy_delete');
    Route::resource('branch_patient', 'User\PatientController');
    Route::post('branch_patient_create_invoice','User\PatientController@store_create_invoice')->name('branch_patient.store_create_invoice');
    Route::post('branch_patient_add_invoice','User\PatientController@branch_patient_invoice')->name('branch_patient_add_test.store_invoice');
    Route::post('branch_patient_test_payement','User\PatientController@branch_patient_test_payement')->name('branch_patient_test_payement');
    Route::post('branch_patient_payement_submit','User\PatientController@branch_patient_payement_submit')->name('branch_patient_payement_submit');
    Route::get('branch_patient_delete/{id}',[UserPatientController::class, 'branch_patient_destroy_delete'])->name('branch_patient.destroy_delete');
    Route::post('branch_patient_filter', 'User\PatientController@branch_patient_filter')->name('branch_patient_filter');
    Route::resource('branch-test-gig', 'User\TestGigController');
    Route::get('branch-test-gig_delete/{id}',[TestGigController::class, 'destroy_delete'])->name('branch-test-gig.destroy_delete');
    Route::resource('branch_expensive_report', 'User\BranchExpensiveReportController');
    Route::get('branch_expensive_report_delete/{id}',[BranchExpensiveReportController::class, 'branch_expensive_report_delete'])->name('branch_expensive_report.destroy_delete');
    Route::resource('branch_profit_report', 'User\BranchProfitController');
    Route::get('branch_profit_report_delete/{id}',[BranchProfitController::class, 'branch_profit_report_delete'])->name('branch_profit_report.destroy_delete');
    Route::post('branch-epensive-report-filter', [BranchExpensiveReportController::class, 'filterReports'])->name('branch-expensive-report.filterReports');
    Route::post('branch-profit-report-filter', [BranchProfitController::class, 'branch_profit_filter'])->name('branch_profit_report.filterReports');
    Route::resource('branch_perission', 'User\BranchPermissionController');
    Route::get('branch_perission_delete/{id}',[BranchPermissionController::class, 'branch_perission_delete'])->name('branch_perission.destroy_delete');
    Route::resource('branch_add_test', 'User\BranchAddTestController');
    Route::get('branch_add_test_delete/{id}',[BranchAddTestController::class, 'branch_add_test_destroy'])->name('branch_add_test.destroy_delete');
    // Route::post('branch_add_test_deletes/{id}',[BranchAddTestController::class, 'branch_add_test_destroy_delete'])->name('branch_add_test.destroy_delete');
    Route::post('branch_add_test_payement', [BranchAddTestController::class, 'add_test_payemnet'])->name('branch_add_test_payemnet');
    Route::post('branch_payement_submit', [BranchAddTestController::class, 'payement_submit'])->name('branch_payement_submit');
    Route::get('branch_search_patient', [BranchAddTestController::class, 'branch_search_patient'])->name('branch_search_patient');
    Route::post('branch_add_test_invoice', [BranchAddTestController::class, 'create_invoice'])->name('branch_add_test.invoice');
    Route::get('branch_patient_invoice/{id}', [BranchAddTestController::class, 'create_invoice'])->name('branch_patient_invoice');

    Route::post('branch_edit_test',[BranchAddTestController::class, 'editStore'])->name('branch_edit_test.editStore');
    Route::post('branch_edit_test_payemnet',[BranchAddTestController::class, 'branch_edit_test_payemnet'])->name('branch_edit_test_payemnet');
    Route::post('branch_edit_payement_submit',[BranchAddTestController::class, 'branch_edit_payement_submit'])->name('branch_edit_payement_submit');

    Route::resource('patient_invoice', 'User\InvoiceController');
    Route::get('patient_invoice_delete/{id}',[InvoiceController::class, 'patient_invoice_delete'])->name('patient_invoice.destroy_delete');
    Route::post('patient_invoice_show',[InvoiceController::class, 'patient_invoice_show'])->name('patient_invoice_show');
    Route::post('branch_user_logout', [UserDashboard::class, 'branch_user_logout'])->name('branch_user_logout');
    Route::resource('branch_patient_report', 'User\PatientReportController');
    Route::get('branch_patient_report_delete/{id}',[PatientReportController::class, 'branch_patient_report_delete'])->name('branch_patient_report.destroy_delete');
    // patient report
    Route::resource('patient_report', 'Patient\PatientReportController');
    Route::get('patient_Invoice',[PatientReportController::class, 'patient_report_invoice'])->name('patient_report.invoice');
    Route::resource('patient_profile', 'Patient\PatientProfile');

    Route::resource('branch_additional_report','User\BranchAdditionalReport');
    Route::get('branch_additional_report_delete/{id}',[BranchAdditionalReport::class, 'delete'])->name('branch_additional_report.destroy_delete');
    // Ali Excel route
    Route::get('branch_profit_export',[BranchProfitController::class, 'export'])->name('branch.profit_export');
    Route::get('branch_expensive_export',[BranchExpensiveReportController::class, 'export'])->name('branch.expensive_export');
});
Route::post("vendor_verification_code_submit", [LoginController::class, 'vendor_verification_code'])->name('vendor_verification_code_submit');

// user routes

Route::get('/{slug}/{requestpath}/{create}/', [BranchPathController::class, 'requestpath_create'])->name('requestpath_create');
Route::get('/{slug}/{requestpath}', [VendorProfileController::class, 'requestpath'])->name('requestpath');
// Route::get('/{slug}/{requestpath}/{branch_path}', [VendorProfileController::class, 'requestpath'])->name('requestpath');
Route::post('login_submit', [UserLoginController::class, 'login_submit'])->name('login_submit');

// vendor routes
// Dileep bhai
Route::get('/{slug}', [LoginController::class, 'user_login_view'])->name('user_login_view');
Route::post('user_login', [LoginController::class, 'user_login_submit'])->name('user_login');
