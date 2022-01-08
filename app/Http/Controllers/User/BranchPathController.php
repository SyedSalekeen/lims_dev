<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Vendor\PermissionId;
use App\Vendor\RolePermission;
use Spatie\Permission\Models\Role;
use App\Patient;
use App\TestGig;
use Spatie\Permission\Models\Permission;
use DB;
use App\ExpensiveReport;
use App\ProfitReport;
use App\AddTest;
use App\VendorBranch;
use App\AddTestReport;
use PDF;
use App\Country;
use App\State;
use App\City;
use App\AddTestDetail;
use App\LabTest;
use App\User\AddTestReportDetail;

class BranchPathController extends Controller
{
    public function requestpath_create(Request $request)
    {

        $myStrings = $request->path();
        if (strpos($myStrings, 'profile_create') !== false) {
            $get_country = Country::all();
            // $get_state = State::all();
            // $get_city = City::all();
            $user = User::find(auth()->id());
            return view('user.profile', get_defined_vars());
        }
        if (strpos($myStrings, 'user_dashboard') !== false) {

            $get_auth_user = User::find(auth()->id());
            $employees = User::where(['type' => "4"])->where(['type' => "5"])
                ->where('branch_id', $get_auth_user->branch_id)->get();
            $employees_details = count($employees);
            $Patients = User::where('branch_id', $get_auth_user->branch_id)->where(['type' => "6"])->get();
            $Patients_details = count($Patients);
            $Expenses_details = ExpensiveReport::where('branch_id', $get_auth_user->branch_id)->sum('expensive_amount');
            $Reports = AddTest::where('id', auth()->user()->branch_id)->get();
            $Reports_details = count($Reports);

            $NetProfit = ProfitReport::where('id', auth()->user()->branch_id)->get();
            $NetProfit_details = count($NetProfit);

            return view('user.dashboard.index', get_defined_vars());
        }
        if (strpos($myStrings, 'branch_user_create') !== false) {
            $get_country = Country::all();
            $get_vendor_branch_role = Role::where('type', '!=', '3')->get();
            return view('user.users.create', get_defined_vars());
        }
        if (strpos($myStrings, 'branch_user_show') !== false) {
            $get_vendor_branch_role = Role::all();
            $user_show = User::find($request->id);
            $get_country = Country::find($user_show->country);
            // return $get_country;
            // $get_state = State::find($user_show->state);
            // $get_city = City::find($user_show->city);

            return view('user.users.show', get_defined_vars());
        }

        if (strpos($myStrings, 'branch_user_edit') !== false) {
            $get_vendor_branch_role = Role::all();
            $user_edit = User::find($request->id);
            $get_country = Country::all();
            // $get_state = State::where('country_id', $user_edit->country)->get();
            // $get_city = City::where('state_id', $user_edit->state)->get();
            return view('user.users.edit', get_defined_vars());
        }
        if (strpos($myStrings, 'branch_user') !== false) {
            $get_auth_user = User::find(auth()->id());
            $get_user = User::where('branch_id', $get_auth_user->branch_id)->first();
            $get_permission = RolePermission::where('role_id', $get_user->role_id)
                ->where('branch_id', $get_user->branch_id)
                ->first();
            // return $get_permission;
            $get_permission_edit_user = PermissionId::where('permission_role_id', @$get_permission->id)
                ->where('branch_id', @$get_permission->branch_id)
                ->where('role_id', @$get_permission->role_id)
                ->where('permission_id', '15')
                ->first();
            $get_permission_delete_user = PermissionId::where('permission_role_id', @$get_permission->id)
                ->where('branch_id', @$get_permission->branch_id)
                ->where('role_id', @$get_permission->role_id)
                ->where('permission_id', '16')
                ->first();
            $user = User::where('branch_id', $get_auth_user->branch_id)->where('type', '!=', '6')->where('type', '!=', $get_auth_user->type)->get();
            return view('user.users.index', get_defined_vars());
        }
        if (strpos($myStrings, 'branch_patient_create') !== false) {
            $get_country = Country::all();
            $get_auth_user = User::find(auth()->id());
            $get_test_gig = TestGig::where("vendor_id", $get_auth_user->vendor_id)->get();
            return view('user.patient.create', get_defined_vars());
        }
        if (strpos($myStrings, 'branch_patient_show') !== false) {
            $get_invoice = AddTest::where('patient_mr_no', $request->patient_id)->get();
            $invoice_count = count($get_invoice);
            // return $invoice_count;
            $get_reports = AddTestReport::where('patient_id', $request->patient_id)->get();
            $report_count = count($get_reports);
            $get_patient = User::where('id', $request->id)->first();
            $get_country = Country::find($get_patient->country);
            // return $get_country;
            // $get_state = State::find($get_patient->state);
            // $get_city = City::find($get_patient->city);

            return view('user.patient.show', get_defined_vars());
        }
        if (strpos($myStrings, 'branch_patient_edit') !== false) {
            $get_patient = User::where('id', $request->id)->first();
            $get_country = Country::all();
            // $get_state = State::where('country_id', $get_patient->country)->get();
            // $get_city = City::where('state_id', $get_patient->state)->get();
            return view('user.patient.edit', get_defined_vars());
        }


        if (strpos($myStrings, 'branch_patient_report_show') !== false) {
            // dd($request->id);
            // $Report = AddTest::find($request->id);
            // dd($invoice);
            // $get_logo = User::find($invoice->vendor_id);
            // $branch_name = VendorBranch::find($invoice->branch_id);
            // $patient_name = User::find($invoice->patient_mr_no);
            // $showreport = AddTestReport::find($request->id);
            $report = AddTestReport::find($request->id);
            $reportDetails = AddTestReportDetail::where('test_report_id', $request->id)->get();
            $get_branch = VendorBranch::find($report->branch_id);
            $get_vendor = User::find($report->vendor_id);
            $get_patient = User::find($report->patient_id);
            $pdf = PDF::loadView('user.test_report.report_pdf', get_defined_vars());
            return $pdf->stream('ducument.pdf');
        }
        if (strpos($myStrings, 'branch_patient_report') !== false) {
            $get_auth_user = User::find(auth()->id());
            $TestReport = AddTestReport::where('branch_id', $get_auth_user->branch_id)->where("invoice_id","!=",null)->get();
            return view('user.test_report.index', get_defined_vars());
        }
        if (strpos($myStrings, 'branch_patient_filter') !== false) {

            $get_auth_user = User::find(auth()->id());
            $get_permission = RolePermission::where('role_id', $get_auth_user->role_id)
                ->where('branch_id', $get_auth_user->branch_id)
                ->first();
            // return $get_permission;
            $get_permission_edit_patient = PermissionId::where('permission_role_id', @$get_permission->id)
                ->where('branch_id', @$get_permission->branch_id)
                ->where('role_id', @$get_permission->role_id)
                ->where('permission_id', '17')
                ->first();
            $get_permission_delete_patient = PermissionId::where('permission_role_id', @$get_permission->id)
                ->where('branch_id', @$get_permission->branch_id)
                ->where('role_id', @$get_permission->role_id)
                ->where('permission_id', '18')
                ->first();
            if ($request->name) {
                $get_patients = User::where("fullname", $request->name)->where("branch_id", $get_auth_user->branch_id)->where("type", "6")->get();
            }
            if ($request->id) {

                $get_patients = User::where("email", $request->id)->where("branch_id", $get_auth_user->branch_id)->where("type", "6")->get();
            }
            return view('user.patient.index', get_defined_vars());
        }


        if (strpos($myStrings, 'branch_patient') !== false) {
            $get_auth_user = User::find(auth()->id());
            // $get_user = User::where('id', auth()->id())->first();
            $get_permission = RolePermission::where('role_id', $get_auth_user->role_id)
                ->where('branch_id', $get_auth_user->branch_id)
                ->first();
            // return $get_permission;
            $get_permission_edit_patient = PermissionId::where('permission_role_id', @$get_permission->id)
                ->where('branch_id', @$get_permission->branch_id)
                ->where('role_id', @$get_permission->role_id)
                ->where('permission_id', '17')
                ->first();
            $get_permission_delete_patient = PermissionId::where('permission_role_id', @$get_permission->id)
                ->where('branch_id', @$get_permission->branch_id)
                ->where('role_id', @$get_permission->role_id)
                ->where('permission_id', '18')
                ->first();

            $get_auth_user = User::find(auth()->id());
            $get_patients = User::where('branch_id', $get_auth_user->branch_id)->where("type", "6")->where('delete_status', '0')->get();
            return view('user.patient.index', get_defined_vars());
        }
        if (strpos($myStrings, 'branch_gigs_create') !== false) {
            $get_lab_test_name = LabTest::all();
            return view('user.test_gig.create', get_defined_vars());
        }
        if (strpos($myStrings, 'branch_gigs_edit') !== false) {
            $get_lab_test_name = LabTest::all();
            $get_edit_gig = TestGig::find($request->id);
            return view('user.test_gig.edit', get_defined_vars());
        }

        if (strpos($myStrings, 'branch_gigs') !== false) {
            $get_auth_user = User::find(auth()->id());
            $get_test_gigs = TestGig::where('branch_id', $get_auth_user->branch_id)->get();
            $get_user = User::where('id', auth()->id())->first();
            $get_permission = RolePermission::where('role_id', $get_user->role_id)
                ->where('branch_id', $get_user->branch_id)
                ->first();
            $get_permission_edit_gig = PermissionId::where('permission_role_id', @$get_permission->id)
                ->where('branch_id', @$get_permission->branch_id)
                ->where('role_id', @$get_permission->role_id)
                ->where('permission_id', '19')
                ->first();
            $get_permission_delete_gig = PermissionId::where('permission_role_id', @$get_permission->id)
                ->where('branch_id', @$get_permission->branch_id)
                ->where('role_id', @$get_permission->role_id)
                ->where('permission_id', '20')
                ->first();
            return view('user.test_gig.index', get_defined_vars());
        }
        if (strpos($myStrings, 'branch_permission_create') !== false) {
            $id = auth()->id();
            $get_auth_user = User::find($id);
            $get_permission_id = RolePermission::where('branch_id', $get_auth_user->branch_id)->first();
            $get_all_permission = PermissionId::where('permission_role_id', $get_permission_id->id)->get();
            $get_vendor_branch_role = Role::where('id', '!=', '1')->get();
            return view('user.role_permission.create', get_defined_vars());
        }
        if (strpos($myStrings, 'branch_permission_show') !== false) {
            $auth_id = auth()->id();
            $get_auth_user = User::find($auth_id);
            $get_permission_id = RolePermission::where('branch_id', $get_auth_user->branch_id)->first();
            $get_all_permission = PermissionId::where('permission_role_id', $get_permission_id->id)->get();
            $get_vendor_branch_role = Role::all();
            $get_permission = RolePermission::where('id', $request->id)->first();
            $permission = Permission::get();
            $rolePermissions = DB::table("permission_ids")->where("permission_ids.permission_role_id", $request->id)
                ->pluck('permission_ids.permission_id', 'permission_ids.permission_id')
                ->all();

            return view('user.role_permission.show', get_defined_vars());
        }

        if (strpos($myStrings, 'branch_permission_edit') !== false) {
            $auth_id = auth()->id();
            $get_auth_user = User::find($auth_id);
            $get_permission_id = RolePermission::where('branch_id', $get_auth_user->branch_id)->first();
            $get_all_permission = PermissionId::where('permission_role_id', $get_permission_id->id)->get();
            $get_vendor_branch_role = Role::all();
            $get_permission = RolePermission::where('id', $request->id)->first();
            $permission = Permission::get();
            $rolePermissions = DB::table("permission_ids")->where("permission_ids.permission_role_id", $request->id)
                ->pluck('permission_ids.permission_id', 'permission_ids.permission_id')
                ->all();

            return view('user.role_permission.edit', get_defined_vars());
        }
        if (strpos($myStrings, 'branch_permission') !== false) {
            $id = auth()->id();
            $get_auth_user = User::find($id);
            $getPermissions  = RolePermission::where('branch_id', $get_auth_user->branch_id)->where('role_id', '!=', '1')->get();
            $get_vendor_branch_role = Role::where('id', '!=', '1');
            return view('user.role_permission.index', get_defined_vars());
        }

        if (strpos($myStrings, 'branch_expensive_report_create') !== false) {
            return view('user.expensive_report.create');
        }
        if (strpos($myStrings, 'branch_expensive_report_show') !== false) {
        }
        if (strpos($myStrings, 'branch_expensive_report_edit') !== false) {
            $get_expensive_reports = ExpensiveReport::find($request->id);
            return view('user.expensive_report.edit', get_defined_vars());
        }
        if (strpos($myStrings, 'branch_expensive_report_filter') !== false) {
            $get_auth_user = User::find(auth()->id());
            $day = $request->day;
            $month = $request->month;
            $year = $request->year;
            $branch_id = $get_auth_user->branch_id;


            $get_user = User::where('id', auth()->id())->first();
            $get_permission = RolePermission::where('role_id', $get_user->role_id)
                ->where('branch_id', $get_user->branch_id)
                ->first();
            // return $get_permission;
            $get_permission_edit_expensive_report = PermissionId::where('permission_role_id', @$get_permission->id)
                ->where('branch_id', @$get_permission->branch_id)
                ->where('role_id', @$get_permission->role_id)
                ->where('permission_id', '23')
                ->first();
            $get_permission_delete_expensive_report = PermissionId::where('permission_role_id', @$get_permission->id)
                ->where('branch_id', @$get_permission->branch_id)
                ->where('role_id', @$get_permission->role_id)
                ->where('permission_id', '24')
                ->first();


            $get_expensive_reports = [];
            if ($request->has('month') && $request->has('day') && $request->has('year')) {
                $get_expensive_reports =  ExpensiveReport::whereYear('expensive_date', $request->year)
                    ->whereMonth('expensive_date', $request->month)
                    ->whereDay('expensive_date', $request->day)
                    ->where('vendor_id', auth()->id())
                    ->where('branch_id', $branch_id)
                    ->get();
            } else if ($request->has('month') && $request->has('year')) {
                $get_expensive_reports =  ExpensiveReport::whereRaw('MONTH(expensive_date) = ' . $month)->whereRaw('YEAR(expensive_date) = ' . $year)->where('branch_id', $branch_id)->get();
            } else if ($request->has('month') && $request->has('day')) {
                $get_expensive_reports =  ExpensiveReport::whereRaw('MONTH(expensive_date) = ' . $month)->whereRaw('DAY(expensive_date) = ' . $day)->where('branch_id', $branch_id)->get();
            } else if ($request->has('day')) {
                $get_expensive_reports =  ExpensiveReport::whereRaw('DAY(expensive_date) = ' . $day)->where('branch_id', $branch_id)->get();
            } else if ($request->has('month')) {
                $get_expensive_reports =  ExpensiveReport::whereRaw('MONTH(expensive_date) = ' . $month)->where('branch_id', $branch_id)->get();
            } else if ($request->has('year')) {
                $get_expensive_reports = ExpensiveReport::whereRaw('Year(expensive_date) = ' . $year)->where('branch_id', $branch_id)->get();
            }

            $data = "true";
            return view('user.expensive_report.index', get_defined_vars());
        }
        if (strpos($myStrings, 'branch_expensive_report') !== false) {
            $get_auth_user = User::find(auth()->id());
            $get_expensive_reports = ExpensiveReport::where('branch_id', $get_auth_user->branch_id)->get();
            // return $get_expensive_reports;
            $get_user = User::where('id', auth()->id())->first();
            $get_permission = RolePermission::where('role_id', $get_user->role_id)
                ->where('branch_id', $get_user->branch_id)
                ->first();
            // return $get_permission;
            $get_permission_edit_expensive_report = PermissionId::where('permission_role_id', @$get_permission->id)
                ->where('branch_id', @$get_permission->branch_id)
                ->where('role_id', @$get_permission->role_id)
                ->where('permission_id', '23')
                ->first();
            $get_permission_delete_expensive_report = PermissionId::where('permission_role_id', @$get_permission->id)
                ->where('branch_id', @$get_permission->branch_id)
                ->where('role_id', @$get_permission->role_id)
                ->where('permission_id', '24')
                ->first();
            return view('user.expensive_report.index', get_defined_vars());
        }
        if (strpos($myStrings, 'branch_profit_create') !== false) {
            return view('user.profit_report.create');
        }
        if (strpos($myStrings, 'branch_profit_edit') !== false) {
            $get_profit_reports = ProfitReport::find($request->id);
            return view('user.profit_report.edit', get_defined_vars());
        }
        if (strpos($myStrings, 'branch_profit_show') !== false) {
        }
        if (strpos($myStrings, 'branch_profit_filter') !== false) {
            $get_auth_user = User::find(auth()->id());
            $day = $request->day;
            $month = $request->month;
            $year = $request->year;
            $branch_id = $get_auth_user->branch_id;
            // dd($branch_id);


            $get_user = User::where('id', auth()->id())->first();
            $get_permission = RolePermission::where('role_id', $get_user->role_id)
                ->where('branch_id', $get_user->branch_id)
                ->first();
            $get_permission_edit_profit_report = PermissionId::where('permission_role_id', @$get_permission->id)
                ->where('branch_id', @$get_permission->branch_id)
                ->where('role_id', @$get_permission->role_id)
                ->where('permission_id', '23')
                ->first();
            $get_permission_delete_profit_report = PermissionId::where('permission_role_id', @$get_permission->id)
                ->where('branch_id', @$get_permission->branch_id)
                ->where('role_id', @$get_permission->role_id)
                ->where('permission_id', '24')
                ->first();


            if ($request->has('month') && $request->has('day') && $request->has('year')) {
                $get_profit_reports =  ProfitReport::whereYear('profit_date', $request->year)
                    ->whereMonth('profit_date', $request->month)
                    ->whereDay('profit_date', $request->day)
                    ->where('vendor_id', auth()->id())
                    ->where('branch_id', $branch_id)
                    ->get();
            } else if ($request->has('month') && $request->has('year')) {
                $get_profit_reports =  ProfitReport::whereRaw('MONTH(profit_date) = ' . $month)->whereRaw('YEAR(profit_date) = ' . $year)->where('branch_id', $branch_id)->get();
            } else if ($request->has('month') && $request->has('day')) {
                $get_profit_reports =  ProfitReport::whereRaw('MONTH(profit_date) = ' . $month)->whereRaw('DAY(profit_date) = ' . $day)->where('branch_id', $branch_id)->get();
            } else if ($request->has('day')) {
                $get_profit_reports =  ProfitReport::whereRaw('DAY(profit_date) = ' . $day)->where('branch_id', $branch_id)->get();
            } else if ($request->has('month')) {
                $get_profit_reports =  ProfitReport::whereRaw('MONTH(profit_date) = ' . $month)->where('branch_id', $branch_id)->get();
            } else if ($request->has('year')) {
                $get_profit_reports = ProfitReport::whereRaw('Year(profit_date) = ' . $year)->where('branch_id', $branch_id)->get();
            }
            $data = "true";
            return view('user.profit_report.index', get_defined_vars());
        }

        if (strpos($myStrings, 'branch_profit') !== false) {
            $get_auth_user = User::find(auth()->id());
            $get_profit_reports = ProfitReport::where('branch_id', $get_auth_user->branch_id)->get();
            $get_user = User::where('id', auth()->id())->first();
            $get_permission = RolePermission::where('role_id', $get_user->role_id)
                ->where('branch_id', $get_user->branch_id)
                ->first();
            $get_permission_edit_profit_report = PermissionId::where('permission_role_id', @$get_permission->id)
                ->where('branch_id', @$get_permission->branch_id)
                ->where('role_id', @$get_permission->role_id)
                ->where('permission_id', '23')
                ->first();
            $get_permission_delete_profit_report = PermissionId::where('permission_role_id', @$get_permission->id)
                ->where('branch_id', @$get_permission->branch_id)
                ->where('role_id', @$get_permission->role_id)
                ->where('permission_id', '24')
                ->first();
            return view('user.profit_report.index', get_defined_vars());
        }


        // add test
        if (strpos($myStrings, 'branch_add_test_create') !== false) {
            $get_auth_user = User::find(auth()->id());
            $get_patients = User::where('branch_id', $get_auth_user->branch_id)->where("type", "6")->get();
            $get_test_gigs = TestGig::where('branch_id', $get_auth_user->branch_id)->get();
            return view('user.add_test.create', get_defined_vars());
        }
        if (strpos($myStrings, 'branch_add_test_edit') !== false) {

            $get_auth_user = User::find(auth()->id());
            $get_add_test = AddTest::find($request->id);
            // return $get_add_test;
            // dd($get_add_test);
            // return $get_add_test->get_gig_name;
            $get_add_test_details = AddTestDetail::where('add_test_id', $request->id)->has('get_gig_name')->get();
            // return $get_add_test_details;

            // return $get_add_test_details;
            // foreach($get_add_test_details as $item){
            //     $findGig[] = TestGig::where('id',$item->gig_id)->get();
            // }
            // return $findGig;
            // return $get_add_test_details;
            // $get_vendor_branch = VendorBranch::where('vendor_id', auth()->id())->get();
            $get_patients = User::where('branch_id', $get_auth_user->branch_id)->where("type", "6")->get();
            $get_test_gig = TestGig::where("branch_id", $get_auth_user->branch_id)->get();
            $add_test = AddTest::where('branch_id', $get_auth_user->branch_id)->has('patientName')->paginate(5);




            // $get_auth_user = User::find(auth()->id());
            // $edit_test = AddTest::find($request->id);
            // $get_patients = User::where('branch_id', $get_auth_user->branch_id)->where("type", "6")->get();
            // $get_test_gigs = TestGig::where('branch_id', $get_auth_user->branch_id)->get();
            // $get_auth_user = User::find(auth()->id());
            // $add_test = AddTest::where('branch_id', $get_auth_user->branch_id)->get();
            // $get_vendor_branch = VendorBranch::where('vendor_id', $get_auth_user->vendor_id)->get();
            // $get_patients = User::where('vendor_id', $get_auth_user->vendor_id)->where("type", "6")->get();
            // $get_test_gig = TestGig::where("vendor_id", $get_auth_user->vendor_id)->get();


            return view('user.add_test.edit', get_defined_vars());
        }
        if (strpos($myStrings, 'branch_invoice') !== false) {
            $invoice = AddTest::find($request->id);
            $get_logo = User::find($invoice->vendor_id);
            $branch_name = VendorBranch::find($invoice->branch_id);
            $patient_name = User::find($invoice->patient_mr_no);
            // return $patient_name;
            return view('user.add_test.invoice', get_defined_vars());
        }
        if (strpos($myStrings, 'branch_add_test') !== false) {
            $get_user = User::where('id', auth()->id())->first();
            $get_permission = RolePermission::where('role_id', $get_user->role_id)
                ->where('branch_id', $get_user->branch_id)
                ->first();
            $get_permission_edit_test = PermissionId::where('permission_role_id', @$get_permission->id)
                ->where('branch_id', @$get_permission->branch_id)
                ->where('role_id', @$get_permission->role_id)
                ->where('permission_id', '29')
                ->first();
            $get_permission_delete_test = PermissionId::where('permission_role_id', @$get_permission->id)
                ->where('branch_id', @$get_permission->branch_id)
                ->where('role_id', @$get_permission->role_id)
                ->where('permission_id', '30')
                ->first();
            $get_auth_user = User::find(auth()->id());
            $add_test = AddTest::where('branch_id', $get_auth_user->branch_id)->get();
            $get_vendor_branch = VendorBranch::where('vendor_id', $get_auth_user->vendor_id)->get();
            $get_patients = User::where('vendor_id', $get_auth_user->vendor_id)->where("type", "6")->get();
            $get_test_gig = TestGig::where("vendor_id", $get_auth_user->vendor_id)->get();
            $add_test = AddTest::where('branch_id', $get_auth_user->branch_id)->has('patientName')->get();
            return view('user.add_test.index', get_defined_vars());
        }



        // patient invoice and report create

        if (strpos($myStrings, 'patient_invoice_show') !== false) {
            $invoice = AddTest::find($request->id);
            $get_logo = User::find($invoice->vendor_id);
            $branch_name = VendorBranch::find($invoice->branch_id);
            $patient_name = User::find($invoice->patient_mr_no);
            return view('user.invoice_report.invoice', get_defined_vars());
        }

        if (strpos($myStrings, 'patient_report_create') !== false) {
            $invoice = AddTest::find($request->id);
            // dd($invoice);
            $get_test_details = AddTestDetail::where('add_test_id', $invoice->id)->get();
            // return $get_test_details;
            foreach ($get_test_details as $item) {
                $get_gigs[] = TestGig::find($item->gig_id);
            }
            // return $get_gigs;
            //
            // $get_range = TestGig::find($invoice->patient_test_name_id);
            $get_logo = User::find($invoice->vendor_id);
            $branch_name = VendorBranch::find($invoice->branch_id);
            $patient_name = User::find($invoice->patient_mr_no);
            $invoice_id = $invoice->id;
            return view('user.invoice_report.report', get_defined_vars());
        }
        if (strpos($myStrings, 'patient_invoice') !== false) {

            $get_auth_user = User::find(auth()->id());
            $add_test = AddTest::where('vendor_id', $get_auth_user->vendor_id)->where('branch_id', $get_auth_user->branch_id)->where('report_status', '0')->get();
            // return $add_test;
            return view('user.invoice_report.index', get_defined_vars());
        }
        if (strpos($myStrings, 'patient_report_show') !== false) {
            // dd($request->id);
            $report = AddTestReport::find($request->id);
            //   dd($report);
            $reportDetails = AddTestReportDetail::where('test_report_id', $request->id)->get();
            $get_branch = VendorBranch::find($report->branch_id);
            $get_vendor = User::find($report->vendor_id);
            $get_patient = User::find($report->patient_id);
            // dd($showreport);
            $pdf = PDF::loadView('patient.reports.report_pdf', get_defined_vars());
            return $pdf->stream('ducument.pdf');
        }

        if (strpos($myStrings, 'patient_report_invoice') !== false) {
            $get_auth_user = User::find(auth()->id());
            // return $get_auth_user;
            $add_test = AddTest::where('patient_mr_no', $get_auth_user->id)->where('branch_id', $get_auth_user->branch_id)->has('patientName')->get();
            // return $add_test;

            return view('patient.invoice.index', get_defined_vars());
        }

        if (strpos($myStrings, 'patient_report') !== false) {
            $get_auth_user = User::find(auth()->id());
            $get_test = AddTestReport::where('patient_id', $get_auth_user->id)->get();
            // dd($get_test);
            return view('patient.reports.index', get_defined_vars());
        }


        if (strpos($myStrings, 'branch_additional_report_create') !== false) {
            $get_auth_user = User::find(auth()->id());
            $getPatients = User::where('branch_id', $get_auth_user->branch_id)->where('type', '6')->get();
            $getTestCategory = LabTest::all();
            return view('user.additional_report.create', get_defined_vars());
        }

        if (strpos($myStrings, 'branch_additional_report') !== false) {
            $get_auth_user = User::find(auth()->id());
            $getAdditionalBranchReports = AddTestReport::where('branch_id', $get_auth_user->branch_id)->where("invoice_id", null)->get();
            return view('user.additional_report.index', get_defined_vars());
        }


        // patient reports





    }
}
