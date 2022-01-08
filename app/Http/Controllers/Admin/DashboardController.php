<?php

namespace App\Http\Controllers\Admin;

use App\AddTestReport;
use App\ChangeTheme;
use App\Country;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\User\AddTestReportDetail;
use App\VendorBranch;
use PDF;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard.index');
    }

    public function themes()
    {

        $get_laborities = User::where('type', '2')->get();
        return view('admin.Theme.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // own functions
    public function vendors_show()
    {

        $vendorslist = User::where(['type' => "2"])->get();
        return view('admin.dashboard.vendors', get_defined_vars());
    }

    public function patient_show()
    {
        // dd('here');

        $patientlist = User::where("type", "6")->has('branch')->get();
        // $AggregateData = user::where('vendor_id',$id)->where("type","6")->get();
        return view('admin.dashboard.patient', get_defined_vars());
    }
    public function branches(request $request)
    {
        // dd('here');
        //  $AggregateData = User::where('id',$id)->get();
        $AggregateData = VendorBranch::all();
        return view('admin.dashboard.branches', get_defined_vars());
    }

    public function admin_theme_change(Request $request)
    {

        $this->validate($request, [
            'sidebar_color' => 'required',
            'navbar_color' => 'required',
            'sidebar_text' => 'required',
            'navbar_text' => 'required',
            'button_color' => 'required',
            'button_text' => 'required',
        ]);
        $checkThemeAlreadyExist = ChangeTheme::where('vendor_id', auth()->id())->first();
        if ($checkThemeAlreadyExist) {
            $save_vendor_theme = ChangeTheme::where("vendor_id", auth()->id())->first();
            // return $save_vendor_theme;
            $save_vendor_theme->vendor_id = auth()->id();
            $save_vendor_theme->sidebar_color = $request->sidebar_color;
            $save_vendor_theme->navbar_color = $request->navbar_color;
            $save_vendor_theme->button_color = $request->button_color;
            $save_vendor_theme->sidebar_text = $request->sidebar_text;
            $save_vendor_theme->navbar_text = $request->navbar_text;
            $save_vendor_theme->button_text = $request->button_text;
            $save_vendor_theme->save();
            session()->put('vendor_theme_updated', true);
            return redirect()->route('themes')
                ->with('success', 'Theme changed successfully');;
        } else {
            $save_vendor_theme = new ChangeTheme();
            $save_vendor_theme->vendor_id = auth()->id();
            $save_vendor_theme->sidebar_color = $request->sidebar_color;
            $save_vendor_theme->navbar_color = $request->navbar_color;
            $save_vendor_theme->button_color = $request->button_color;
            $save_vendor_theme->sidebar_text = $request->sidebar_text;
            $save_vendor_theme->navbar_text = $request->navbar_text;
            $save_vendor_theme->button_text = $request->button_text;
            $save_vendor_theme->save();
            session()->put('vendor_theme_saved', true);
            return redirect()->route('themes')
                ->with('success', 'Theme updated successfully');;
        }
    }
    public function laboratory_theme_change(Request $request)
    {
        $this->validate($request, [
            'sidebar_color' => 'required',
            'navbar_color' => 'required',
            'sidebar_text' => 'required',
            'navbar_text' => 'required',
            'button_color' => 'required',
            'button_text' => 'required',
            'laboratory_id' => 'required',
        ]);
        // dd($request->all());
        $checkLaboratoryThemeAlreadyExist = ChangeTheme::where("vendor_id", $request->laboratory_id)->first();
        if ($checkLaboratoryThemeAlreadyExist) {
            $save_laboratory_theme = ChangeTheme::where("vendor_id", $request->laboratory_id)->first();
            // return $save_vendor_theme;
            $save_laboratory_theme->vendor_id = $request->laboratory_id;
            $save_laboratory_theme->sidebar_color = $request->sidebar_color;
            $save_laboratory_theme->navbar_color = $request->navbar_color;
            $save_laboratory_theme->button_color = $request->button_color;
            $save_laboratory_theme->sidebar_text = $request->sidebar_text;
            $save_laboratory_theme->navbar_text = $request->navbar_text;
            $save_laboratory_theme->button_text = $request->button_text;
            $save_laboratory_theme->save();
            session()->put('vendor_theme_updated', true);
            return redirect()->route('themes')
                ->with('success', 'Laboratory theme changed successfully');;
        } else {
            $save_laboratory_theme = new ChangeTheme();
            $save_laboratory_theme->vendor_id = $request->laboratory_id;
            $save_laboratory_theme->sidebar_color = $request->sidebar_color;
            $save_laboratory_theme->navbar_color = $request->navbar_color;
            $save_laboratory_theme->button_color = $request->button_color;
            $save_laboratory_theme->sidebar_text = $request->sidebar_text;
            $save_laboratory_theme->navbar_text = $request->navbar_text;
            $save_laboratory_theme->button_text = $request->button_text;
            $save_laboratory_theme->save();
            session()->put('vendor_theme_saved', true);
            return redirect()->route('themes')
                ->with('success', 'Laboratory theme updated successfully');;
        }
    }
    public function agregateData()
    {
        $lab_filter = User::where(['type' => "2"])->get();
        return view('admin.dashboard.aggregate_data', get_defined_vars());
    }
    public function get_branches(Request $request)
    {
        $getBrancheName = VendorBranch::where('vendor_id', $request->id)->get();
        return ["data" => $getBrancheName];
    }
    public function agregateDataFilter(Request $request)
    {
        if ($request->age == "" && $request->filter_type == "") {
            session()->put("agregate_data_field_is_required",true);
            return back();
        } else {
            $this->validate($request, [
                'age' => 'required',
                'filter_type' => 'required',
            ]);
            $Array_Agregate = (explode("-", $request->age));
            if ($request->filter_type == "Patient") {
                if ($request->has('age') && $request->has('filter_type') && $request->has('lab_id') && $request->has('branch_id')) {
                    $getFilterPatients = User::where("age", '>=', $Array_Agregate[0])->where("age", '<=', $Array_Agregate[1])->where('vendor_id', $request->lab_id)->where('branch_id', $request->branch_id)->where("type", "6")->has('branch')->get();
                    // return$getFilterPatients;
                }
                if ($request->has('age') && $request->has('filter_type') && $request->has('lab_id')) {
                    $getFilterPatients = User::where("age", '>=', $Array_Agregate[0])->where("age", '<=', $Array_Agregate[1])->where('vendor_id', $request->lab_id)->where("type", "6")->has('branch')->get();
                    // return$getFilterPatients;
                }
                if ($request->has('age') && $request->has('filter_type')) {
                    $getFilterPatients = User::where("age", '>=', $Array_Agregate[0])->where("age", '<=', $Array_Agregate[1])->where("type", "6")->has('branch')->get();
                    // return$getFilterPatients;
                }
                $filterPatientCount = count($getFilterPatients);
                $lab_filter = User::where(['type' => "2"])->get();
                $filterType = "patient";
                $backButton = "true";
                return view('admin.dashboard.aggregate_data', get_defined_vars());
            }
            if ($request->filter_type == "Report") {
                if ($request->has('age') && $request->has('filter_type') && $request->has('lab_id') && $request->has('branch_id')) {
                    $getFilterPatientsReport = AddTestReport::where("age", '>=', $Array_Agregate[0])->where("age", '<=', $Array_Agregate[1])->where('vendor_id', $request->lab_id)->where('branch_id', $request->branch_id)->has('get_patient_name')->has('get_branch_name')->get();
                }
                if ($request->has('age') && $request->has('filter_type') && $request->has('lab_id')) {
                    $getFilterPatientsReport  = AddTestReport::where("age", '>=', $Array_Agregate[0])->where("age", '<=', $Array_Agregate[1])->where('vendor_id', $request->lab_id)->has('get_patient_name')->has('get_branch_name')->get();
                }
                if ($request->has('age') && $request->has('filter_type')) {
                    $getFilterPatientsReport = AddTestReport::where("age", '>=', $Array_Agregate[0])->where("age", '<=', $Array_Agregate[1])->has('get_patient_name')->has('get_branch_name')->get();
                }

                $filterReportCount = count($getFilterPatientsReport);
                $lab_filter = User::where(['type' => "2"])->get();
                $filterType = "report";
                $backButton = "true";
                return view('admin.dashboard.aggregate_data', get_defined_vars());
            }
        }
    }


    public function agergate_data_patient($id)
    {
        $getPatients = User::find($id);
        $get_country = Country::find($getPatients->country);
        $getVendorBranch = VendorBranch::all();
        return view('admin.dashboard.patient_details', get_defined_vars());
    }
    public function patient_report($id)
    {
        $getPatientId = AddTestReport::find($id);
        $getVendorId = User::find($getPatientId->patient_id);
        $get_branch_logo = \App\User::where('id', $getVendorId->vendor_id)->first();
        $vendor_branch_find = \App\VendorBranch::find($getVendorId->branch_id);
        $report = AddTestReport::find($id);
        $reportDetails = AddTestReportDetail::where('test_report_id', $id)->get();
        $get_branch = VendorBranch::find($report->branch_id);
        $get_vendor = User::find($report->vendor_id);
        $get_patient = User::find($report->patient_id);
        // dd($showreport);
        $pdf = PDF::loadView('admin.dashboard.report_pdf', get_defined_vars());
        return $pdf->stream('ducument.pdf');
    }
}
