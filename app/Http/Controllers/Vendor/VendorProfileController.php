<?php

namespace App\Http\Controllers\Vendor;

use App\AddTest;
use App\AddTestDetail;
use App\ExpensiveReport;
use App\Http\Controllers\Controller;
use App\Patient;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\VendorBranch;
use Spatie\Permission\Models\Role;
use App\Vendor\RolePermission;
use Spatie\Permission\Models\Permission;
use App\TestGig;
use App\ProfitReport;
use DB;
use App\AddTestReport;
use App\City;
use Illuminate\Support\Facades\Auth;
use PDF;
use App\Country;
use App\LabTest;
use App\State;
use App\ChangeTheme;
use App\User\AddTestReportDetail;

class VendorProfileController extends Controller
{
    // public function edit()
    // {
    //     $user = User::find(auth()->id());
    //     return view('vendor.profile', get_defined_vars());
    // }


    public function edit(Request $request)
    {

        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => $request->path()]);
    }
    public function create_slug_new()
    {
        return  $user = User::find(auth()->id());


        return view('vendor.profile', get_defined_vars());
    }

    public function requestpath(Request $request)
    {

        $myString = $request->path();




        // return "a";
        if (strpos($myString, 'vendor_branch_create') !== false) {
            return view('vendor.branch.create');
        }


        if (strpos($myString, 'vendor_branch_edit') !== false) {
            $branch = VendorBranch::find($request->branch_id);
            return view('vendor.branch.edit', compact('branch'));
        }


        // if ($request->path() == 'vendor_branch') {
        if (strpos($myString, 'vendor_branch') !== false) {
            $shop = VendorBranch::where('delete_status', '0')->where('vendor_id', auth()->id())->orderBy('id', 'DESC')->paginate(5);
            // $branch_name =
            return view('vendor.branch.index', compact('shop'))
                ->with('i', ($request->input('page', 1) - 1) * 5);
        }
        // }
        if (strpos($myString, 'vendor_user_create') !== false) {
            $get_country = Country::all();
            $get_vendor_branch = VendorBranch::where('vendor_id', auth()->id())->where('delete_status', '0')->where('status', '1')->get();
            $get_vendor_branch_role = Role::all();
            return view('vendor.user.create', get_defined_vars());
        }
        if (strpos($myString, 'vendor_user_edit') !== false) {

            $get_vendor_branch = VendorBranch::where('vendor_id', auth()->id())->where('delete_status', '0')->where('status', '1')->get();
            $get_vendor_branch_role = Role::all();
            $user_edit = User::find($request->user_id);
            $get_country = Country::all();
            // $get_state = State::where('country_id', $user_edit->country)->get();
            // $get_city = City::where('state_id', $user_edit->state)->get();
            return view('vendor.user.edit', get_defined_vars());

            // return view('vendor.user.create', get_defined_vars());
        }
        if (strpos($myString, 'vendor_user_show') !== false) {
            $get_vendor_branch = VendorBranch::where('vendor_id', auth()->id())->where('delete_status', '0')->where('status', '1')->get();
            $get_vendor_branch_role = Role::all();
            $user_show = User::find($request->user_id);
            $get_country = Country::find($user_show->country);
            // return $get_country;
            // $get_state = State::find($user_show->state);
            // $get_city = City::find($user_show->city);
            // return $get_city;
            return view('vendor.user.show', get_defined_vars());

            return view('vendor.user.create', get_defined_vars());
        }

        if (strpos($myString, 'vendor_user') !== false) {

            $user = User::where('vendor_id', auth()->id())->where("type", '!=', '6')->where('delete_status', '0')->has('branch')->get();
            return view('vendor.user.index', get_defined_vars());
        }

        if (strpos($myString, 'role_permission_create') !== false) {
            $permission = Permission::get();
            $get_vendor_branch = VendorBranch::where('vendor_id', auth()->id())->where('delete_status', '0')->where('status', '1')->get();
            $get_vendor_branch_role = Role::all();
            return view('vendor.role_permission.create', get_defined_vars());
        }

        if (strpos($myString, 'role_permission_show') !== false) {
            $permission = Permission::get();
            $rolePermissions = DB::table("permission_ids")->where("permission_ids.permission_role_id", $request->id)
                ->pluck('permission_ids.permission_id', 'permission_ids.permission_id')
                ->all();
            return view('vendor.role_permission.show', get_defined_vars());
        }


        if (strpos($myString, 'role_permission_edit') !== false) {
            $editId = $request->id;
            $get_vendor_branch = VendorBranch::where('vendor_id', auth()->id())->where('delete_status', '0')->where('status', '1')->get();
            $get_vendor_branch_role = Role::all();
            $get_permission = RolePermission::where('id', $editId)->first();
            $permission = Permission::get();
            $rolePermissions = DB::table("permission_ids")->where("permission_ids.permission_role_id", $editId)
                ->pluck('permission_ids.permission_id', 'permission_ids.permission_id')
                ->all();
            // $permission = Permission::get();
            // $getting_permissions = PermissionId::where('permission_role_id', $id)->get();
            // dd($getting_permissions);

            return view('vendor.role_permission.edit', get_defined_vars());
        }

        if (strpos($myString, 'role_permission') !== false) {
            $getPermissions  = RolePermission::where('vendor_id', auth()->id())->has('branch_name')->get();
            $get_vendor_branch_role = Role::all();
            return view('vendor.role_permission.index', get_defined_vars());
        }
        if (strpos($myString, 'vendor_verification_code_view') !== false) {
            $email = $request->email;
            // return $email;
            $get_user = User::where('email', $email)->first();
            // return $get_user;
            $get_color = ChangeTheme::where('vendor_id', $get_user->id)->first();
            // return $get_color;
            return view('vendor.mail.verification_code_view', get_defined_vars());
        }

        if (strpos($myString, 'vendor_dashboard') !== false) {
            $get_auth_user = User::find(auth()->id());
            return view('admin.vendor_dashboard.index', get_defined_vars());
        }
        // patient
        if (strpos($myString, 'patient_index') !== false) {
            $get_vendor_branch = VendorBranch::where('vendor_id', auth()->id())->where('delete_status', '0')->where('status', '1')->get();
            $get_patients = User::where('vendor_id', auth()->id())->where("type", "6")->where('delete_status', '0')->has('branch')->get();
            // return $get_patients;
            return view('vendor.patient.index', get_defined_vars());
        }

        if (strpos($myString, 'patient_filter') !== false) {

            $get_vendor_branch = VendorBranch::where('vendor_id', auth()->id())->where('delete_status', '0')->where('status', '1')->get();
            if ($request->id) {
                $get_patients = User::where("branch_id", $request->id)->where("type", "6")->get();
            }
            if ($request->id && $request->mr) {
                $get_patients = User::where("email", $request->mr)->get();
            }
            if ($request->id && $request->name) {
                $get_patients = User::where("fullname", $request->name)->where("branch_id", $request->id)->where("type", "6")->get();
            }
            return view('vendor.patient.index', get_defined_vars());
        }


        if (strpos($myString, 'patient_create') !== false) {
            $get_country = Country::all();
            $get_vendor_branch = VendorBranch::where('vendor_id', auth()->id())->where('status', '1')->get();
            $get_patients = User::where('vendor_id', auth()->id())->where("type", "6")->get();
            $get_test_gig = TestGig::where("vendor_id", auth()->id())->get();
            return view('vendor.patient.create', get_defined_vars());
        }
        if (strpos($myString, 'patient_edit') !== false) {
            $get_vendor_branch = VendorBranch::where('vendor_id', auth()->id())->where('delete_status', '0')->where('status', '1')->get();
            $get_patient = User::where('id', $request->patient_id)->first();
            $get_country = Country::all();
            // $get_state = State::where('country_id', $get_patient->country)->get();
            // $get_city = City::where('state_id', $get_patient->state)->get();
            return view('vendor.patient.edit', get_defined_vars());
        }
        if (strpos($myString, 'show_patient') !== false) {
            $get_invoice = AddTest::where('patient_mr_no', $request->patient_id)->get();
            $invoice_count = count($get_invoice);
            $get_reports = AddTestReport::where('patient_id', $request->patient_id)->get();
            $report_count = count($get_reports);
            $get_vendor_branch = VendorBranch::where('vendor_id', auth()->id())->where('delete_status', '0')->where('status', '1')->get();
            $get_patient = User::where('id', $request->patient_id)->first();
            $get_country = Country::find($get_patient->country);
            // return $get_country;
            // $get_state = State::find($get_patient->state);
            // $get_city = City::find($get_patient->city);
            return view('vendor.patient.show', get_defined_vars());
        }
        if (strpos($myString, 'test_gig_index') !== false) {

            $get_test_gigs = TestGig::where('vendor_id', auth()->id())->get();
            return view('vendor.test_gig.index', get_defined_vars());
        }
        if (strpos($myString, 'test_gig_create') !== false) {
            $get_vendor_branch = VendorBranch::where('vendor_id', auth()->id())->where('delete_status', '0')->where('status', '1')->get();
            $get_lab_test_name = LabTest::all();
            return view('vendor.test_gig.create', get_defined_vars());
        }

        if (strpos($myString, 'test_gig_edit') !== false) {
            $get_vendor_branch = VendorBranch::where('vendor_id', auth()->id())->where('delete_status', '0')->where('status', '1')->get();
            $get_edit_gig = TestGig::find($request->id);
            $get_lab_test_name = LabTest::all();
            return view('vendor.test_gig.edit', get_defined_vars());
        }

        // expensive report
        if (strpos($myString, 'expensive_report_create') !== false) {
            $get_vendor_branch = VendorBranch::where('vendor_id', auth()->id())->where('delete_status', '0')->where('status', '1')->get();
            return view('vendor.expensive_report.create', get_defined_vars());
        }

        if (strpos($myString, 'expensive_report_index') !== false) {
            $get_vendor_branch = VendorBranch::where('vendor_id', auth()->id())->where('delete_status', '0')->where('status', '1')->get();
            $get_expensive_reports = ExpensiveReport::where('vendor_id', auth()->id())->get();
            // return $get_expensive_reports;
            return view('vendor.expensive_report.index', get_defined_vars());
        }

        if (strpos($myString, 'expensive_report_edit') !== false) {
            $get_vendor_branch = VendorBranch::where('vendor_id', auth()->id())->where('delete_status', '0')->where('status', '1')->get();
            $get_expensive_reports = ExpensiveReport::where('id', $request->id)->first();
            // return $get_expensive_reports;
            return view('vendor.expensive_report.edit', get_defined_vars());
        }

        if (strpos($myString, 'expensive_report_filter') !== false) {
            //            dd('here');
            $day = $request->day;
            $month = $request->month;
            $year = $request->year;
            $branch_id = $request->branch_id;
            $get_expensive_reports = [];
            if ($request->has('month') && $request->has('day') && $request->has('year') && $request->has('branch_id')) {
                $get_expensive_reports =  ExpensiveReport::whereYear('expensive_date', $request->year)
                    ->whereMonth('expensive_date', $request->month)
                    ->whereDay('expensive_date', $request->day)
                    ->where('vendor_id', auth()->id())
                    ->where('branch_id', $branch_id)
                    ->get();
            } else if ($request->has('month') && $request->has('day') && $request->has('year')) {
                //                dd("here");
                $get_expensive_reports =  ExpensiveReport::whereYear('expensive_date', $request->year)
                    ->whereMonth('expensive_date', $request->month)
                    ->whereDay('expensive_date', $request->day)
                    ->where('vendor_id', auth()->id())
                    ->get();
            } else if ($request->has('month') && $request->has('year')) {
                $get_expensive_reports =  ExpensiveReport::whereRaw('MONTH(expensive_date) = ' . $month)->whereRaw('YEAR(expensive_date) = ' . $year)->where('vendor_id', auth()->id())->where('branch_id', $branch_id)->get();
            } else if ($request->has('day') && $request->has('branch_id')) {
                $get_expensive_reports =  ExpensiveReport::whereRaw('DAY(expensive_date) = ' . $day)->where('vendor_id', auth()->id())->where('branch_id', $branch_id)->get();
            } else if ($request->has('month') && $request->has('branch_id')) {
                $get_expensive_reports =  ExpensiveReport::whereRaw('MONTH(expensive_date) = ' . $month)->where('vendor_id', auth()->id())->where('branch_id', $branch_id)->get();
            } else if ($request->has('year') && $request->has('branch_id')) {
                $get_expensive_reports = ExpensiveReport::whereRaw('Year(expensive_date) = ' . $year)->where('vendor_id', auth()->id())->where('branch_id', $branch_id)->get();
            } else if ($request->has('day')) {
                $get_expensive_reports =  ExpensiveReport::whereRaw('DAY(expensive_date) = ' . $day)->where('vendor_id', auth()->id())->get();
            } else if ($request->has('month')) {
                $get_expensive_reports =  ExpensiveReport::whereRaw('MONTH(expensive_date) = ' . $month)->where('vendor_id', auth()->id())->get();
            } else if ($request->has('year')) {
                $get_expensive_reports = ExpensiveReport::whereRaw('Year(expensive_date) = ' . $year)->where('vendor_id', auth()->id())->get();
            } else if ($branch_id) {
                $get_expensive_reports = ExpensiveReport::where('branch_id', $branch_id)->get();
            }
            //            return $get_expensive_reports;
            $data = "true";
            $get_vendor_branch = VendorBranch::where('vendor_id', auth()->id())->where('delete_status', '0')->where('status', '1')->get();
            return view('vendor.expensive_report.index', get_defined_vars());
        }
        // profit report
        if (strpos($myString, 'profit_report_index') !== false) {
            $get_vendor_branch = VendorBranch::where('vendor_id', auth()->id())->where('delete_status', '0')->where('status', '1')->get();
            $get_profit_reports = ProfitReport::where('vendor_id', auth()->id())->get();
            // return $get_expensive_reports;
            return view('vendor.profit_report.index', get_defined_vars());
        }

        if (strpos($myString, 'profit_report_create') !== false) {
            $get_vendor_branch = VendorBranch::where('vendor_id', auth()->id())->where('delete_status', '0')->where('status', '1')->get();
            return view('vendor.profit_report.create', get_defined_vars());
        }

        if (strpos($myString, 'profit_report_edit') !== false) {
            $get_vendor_branch = VendorBranch::where('vendor_id', auth()->id())->where('delete_status', '0')->where('status', '1')->get();
            $get_profit_reports = ProfitReport::find($request->id);
            // return $get_expensive_reports;
            return view('vendor.profit_report.edit', get_defined_vars());
        }
        if (strpos($myString, 'profit_report_filter') !== false) {
            $day = $request->day;
            $month = $request->month;
            $year = $request->year;
            $branch_id = $request->branch_id;
            $get_profit_reports = [];
            if ($request->has('month') && $request->has('day') && $request->has('year') && $request->has('branch_id')) {
                $get_profit_reports =  ProfitReport::whereYear('created_at', $request->year)
                    ->whereMonth('profit_date', $request->month)
                    ->whereDay('profit_date', $request->day)
                    ->where('vendor_id', auth()->id())
                    ->where('branch_id', $branch_id)
                    ->get();
            } else if ($request->has('month') && $request->has('day') && $request->has('year')) {
                //                dd("here");
                $get_profit_reports =  ProfitReport::whereYear('profit_date', $request->year)
                    ->whereMonth('profit_date', $request->month)
                    ->whereDay('profit_date', $request->day)
                    ->where('vendor_id', auth()->id())
                    ->get();
            } else if ($request->has('month') && $request->has('year')) {
                $get_profit_reports =  ProfitReport::whereRaw('MONTH(profit_date) = ' . $month)->whereRaw('YEAR(profit_date) = ' . $year)->where('vendor_id', auth()->id())->where('branch_id', $branch_id)->get();
            } else if ($request->has('day') && $request->has('branch_id')) {
                $get_profit_reports =  ProfitReport::whereRaw('DAY(profit_date) = ' . $day)->where('vendor_id', auth()->id())->where('branch_id', $branch_id)->get();
            } else if ($request->has('month') && $request->has('branch_id')) {
                $get_profit_reports =  ProfitReport::whereRaw('MONTH(profit_date) = ' . $month)->where('vendor_id', auth()->id())->where('branch_id', $branch_id)->get();
            } else if ($request->has('year') && $request->has('branch_id')) {
                $get_profit_reports = ProfitReport::whereRaw('Year(profit_date) = ' . $year)->where('vendor_id', auth()->id())->where('branch_id', $branch_id)->get();
            } else if ($request->has('day')) {
                $get_profit_reports =  ProfitReport::whereRaw('DAY(profit_date) = ' . $day)->where('vendor_id', auth()->id())->get();
            } else if ($request->has('month')) {

                $get_profit_reports =  ProfitReport::whereRaw('MONTH(profit_date) = ' . $month)->where('vendor_id', auth()->id())->get();
                // return $get_profit_reports;
            } else if ($request->has('year')) {
                $get_profit_reports = ProfitReport::whereRaw('Year(profit_date) = ' . $year)->where('vendor_id', auth()->id())->get();
            } else if ($branch_id) {
                $get_profit_reports = ProfitReport::where('branch_id', $branch_id)->get();
            }
            //            return $get_expensive_reports;
            $data = "true";
            $get_vendor_branch = VendorBranch::where('vendor_id', auth()->id())->where('delete_status', '0')->where('status', '1')->get();
            return view('vendor.profit_report.index', get_defined_vars());
        }

        // add test
        if (strpos($myString, 'test_create') !== false) {
            $get_vendor_branch = VendorBranch::where('vendor_id', auth()->id())->where('delete_status', '0')->where('status', '1')->get();
            $get_patients = User::where('vendor_id', auth()->id())->where("type", "6")->get();
            $get_test_gigs = TestGig::where('vendor_id', auth()->id())->get();
            return view('vendor.add_test.create', get_defined_vars());
        }
        if (strpos($myString, 'add_test_invoice') !== false) {
            $invoice = AddTest::find($request->id);
            // return $invoice;
            $get_logo = User::find($invoice->vendor_id);
            $branch_name = VendorBranch::find($invoice->branch_id);
            $patient_name = User::find($invoice->patient_mr_no);
            // return $patient_name;
            // return $patient_name;
            return view('vendor.add_test.invoice', get_defined_vars());
        }
        if (strpos($myString, 'add_test') !== false) {

            $get_vendor_branch = VendorBranch::where('vendor_id', auth()->id())->get();
            $get_patients = User::where('vendor_id', auth()->id())->where("type", "6")->get();
            $get_test_gig = TestGig::where("vendor_id", auth()->id())->get();
            $add_test = AddTest::where('vendor_id', auth()->id())->has('patientName')->paginate(5);
            return view('vendor.add_test.index', get_defined_vars());
        }
        if (strpos($myString, 'test_edit') !== false) {
            // dd($request->id);
            $get_add_test = AddTest::find($request->id);
            // dd($request->id);
            // return $get_add_test->get_gig_name;
            $get_add_test_details = AddTestDetail::where('add_test_id', $request->id)->has('get_gig_name')->get();
            // return $get_add_test_details;

            // return $get_add_test_details;
            // foreach($get_add_test_details as $item){
            //     $findGig[] = TestGig::where('id',$item->gig_id)->get();
            // }
            // return $findGig;
            // return $get_add_test_details;
            $get_vendor_branch = VendorBranch::where('vendor_id', auth()->id())->get();
            $get_patients = User::where('vendor_id', auth()->id())->where("type", "6")->get();
            $get_test_gig = TestGig::where("vendor_id", auth()->id())->get();
            $add_test = AddTest::where('vendor_id', auth()->id())->has('patientName')->paginate(5);
            // return $get_test_gigs;
            return view('vendor.add_test.edit', get_defined_vars());
        }
        if (strpos($myString, 'test_show') !== false) {
            $edit_test = AddTest::find($request->id);
            $get_vendor_branch = VendorBranch::where('vendor_id', auth()->id())->where('delete_status', '0')->where('status', '1')->get();
            $get_patients = Patient::where('vendor_id', auth()->id())->get();
            // return $get_patients;
            $get_test_gigs = TestGig::where('vendor_id', auth()->id())->get();
            // return $get_test_gigs;
            return view('vendor.add_test.show', get_defined_vars());
        }

        // add test report
        if (strpos($myString, 'test_report_create') !== false) {
            $get_vendor_branch = VendorBranch::where('vendor_id', auth()->id())->where('delete_status', '0')->where('status', '1')->get();
            $get_patients = Patient::where('vendor_id', auth()->id())->get();
            return view('vendor.test_report.create', get_defined_vars());
        }
        if (strpos($myString, 'test_report_show') !== false) {
            $report = AddTestReport::find($request->id);
            $reportDetails = AddTestReportDetail::where('test_report_id', $request->id)->get();
            $get_branch = VendorBranch::find($report->branch_id);
            $get_vendor = User::find($report->vendor_id);
            $get_patient = User::find($report->patient_id);

            // $invoice = AddTest::find($request->id);
            // $get_logo = User::find($invoice->vendor_id);
            // $branch_name = VendorBranch::find($invoice->branch_id);
            // $patient_name = User::find($invoice->patient_mr_no);
            // $showreport = AddTestReport::find($request->id);
            // $showreport = AddTestReport::find($request->id);
            $pdf = PDF::loadView('vendor.test_report.report_pdf', get_defined_vars());
            return $pdf->stream('ducument.pdf');
        }
        if (strpos($myString, 'test_report') !== false) {
            $TestReport = AddTestReport::where('vendor_id', auth()->id())->where('invoice_id',"!=",null)->get();
            // return $TestReport;
            return view('vendor.test_report.index', get_defined_vars());
        }
        if (strpos($myString, 'vendor_add_report') !== false) {
            $get_auth_user = User::find(auth()->id());
            $add_test = AddTest::where('vendor_id', $get_auth_user->id)->where('report_status', '0')->get();
            return view('vendor.add_report.index', get_defined_vars());
        }
        if (strpos($myString, 'vendor_create_report') !== false) {
            $invoice = AddTest::find($request->id);
            $get_test_details = AddTestDetail::where('add_test_id', $invoice->id)->get();
            foreach ($get_test_details as $item) {
                $get_gigs[] = TestGig::find($item->gig_id);
            }
            // return $get_gigs;
            $get_logo = User::find($invoice->vendor_id);
            $branch_name = VendorBranch::find($invoice->branch_id);
            $patient_name = User::find($invoice->patient_mr_no);
            $invoiceId = $request->id;
            return view('vendor.add_report.report', get_defined_vars());
        }
        if (strpos($myString, 'theme_change') !== false) {
            $get_branches = VendorBranch::where('vendor_id', auth()->id())->get();
            return view('vendor.Theme.index', get_defined_vars());
        }
        if (strpos($myString, 'additional_report_create') !== false) {
            $getPatients = User::where('vendor_id', auth()->id())->where('type', "6")->get();
            $getTestCategory = LabTest::all();
            $getBranch = VendorBranch::where('vendor_id', auth()->id())->get();
            return view('vendor.additional_report.create', get_defined_vars());
        }
        if (strpos($myString, 'additional_report') !== false) {
            $getAdditionalReport = AddTestReport::where('invoice_id', null)->where('vendor_id', auth()->id())->get();
            return view('vendor.additional_report.index', get_defined_vars());
        }


        // $user = User::find(auth()->id());
        // return view('vendor.profile', get_defined_vars());
        // Dileep Bhai
        if (isset(Auth()->user()->id)) {
            if (Auth()->user()->type == 2) {
                $user = User::find(auth()->id());
                $get_country  = Country::all();
                // $get_city = City::all();
                // $get_state = State::all();
                return view('vendor.profile', get_defined_vars());
            }

            if (Auth()->user()->type == "3" || Auth()->user()->type == "4" || Auth()->user()->type == "5") {

                return view('user.layouts.master');
            }
            if (Auth()->user()->type == "6") {
                return view('patient.layouts.master');
            }
        } else {

            $vendor_branch_find = VendorBranch::where('branch_url', url()->current())->first();
            session()->put('url_current_for_user_logout', url()->current());
            if ($vendor_branch_find) {
                $get_branch_logo = User::find($vendor_branch_find->vendor_id);
                session()->put('branch_name', $vendor_branch_find->branch_slug);
                $vendor_branch_find->branch_slug;
                // return $vendor_branch_find;
                $get_color = ChangeTheme::where('branch_id', $vendor_branch_find->id)->first();

                return view('user.login', get_defined_vars());
            } else {
                return redirect('/');
            }


            if (session()->get('branch_user_logout')) {
                return view('user.login');
            } else {

                // session()->forget('branch_user_logout');
            }
        }
    }



    public function vendor_profile_update(Request $request, $id)
    {
        // dd($id);
        // dd($request->all());
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'contact_number' => 'required|max:11',
            'country' => 'required',
            'city' => 'required',
            'state' => 'required',
            'address' => 'required',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:7168|sometimes',
        ]);
        $update_vendor = User::find($id);
        // dd($update_vendor);
        $update_vendor->first_name = $request->first_name;
        $update_vendor->last_name = $request->last_name;

        if ($request->password) {
            $update_vendor->password = Hash::make($request->password);
        }
        if ($request->hasfile('profile_image')) {
            $file = $request->file('profile_image');
            $extension = $file->getClientOriginalExtension();
            $filename = uniqid() . "." . $extension;
            $file->move(public_path('uploads/profile/'), $filename);
            $update_vendor->profile_image = $filename;
        }

        $update_vendor->contact_number = $request->contact_number;
        $update_vendor->city = $request->city;
        $update_vendor->state = $request->state;
        $update_vendor->country = $request->country;
        $update_vendor->address = $request->address;
        $update_vendor->save();
        session()->put('vendor_profile_updated', true);
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "vendor_dashboard"]);
    }
}
