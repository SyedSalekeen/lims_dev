<?php

namespace App\Http\Controllers\User;

use App\AddTestReport;
use App\Http\Controllers\Controller;
use App\LabTest;
use App\User;
use App\VendorBranch;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BranchAdditionalReport extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branch_details = VendorBranch::where('id', auth()->user()->branch_id)->first();
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => $branch_details->branch_slug, 'create' => 'branch_additional_report']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branch_details = VendorBranch::where('id', auth()->user()->branch_id)->first();
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => $branch_details->branch_slug, 'create' => 'branch_additional_report_create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'patient_id' => 'required',
            'test_category' => 'required',
            'test_report' => 'required|mimes:pdf|max:2048',
        ]);
        $getTestName = LabTest::find($request->test_category);

        $get_auth_user = User::find(auth()->id());
        $get_patient_name = User::find($request->patient_id);
        $get_branch_name = VendorBranch::find($get_auth_user->branch_id);
        $add_additional_test = new AddTestReport();
        $add_additional_test->vendor_id = auth()->id();
        $add_additional_test->branch_id = $get_branch_name->id;
        $add_additional_test->patient_id = $request->patient_id;
        $add_additional_test->age = $get_patient_name->age;
        $add_additional_test->laboratory_name = $get_auth_user->laboratory_name;
        $add_additional_test->lab_test_name = $getTestName->lab_test_name;
        $add_additional_test->patient_name = $get_patient_name->fullname;
        $add_additional_test->branch_name = $get_branch_name->branch_name;

        if ($request->file('test_report')) {
            $testReport = $request->test_report;
            $attachSatResultName = Str::random(10) . '.' . $testReport->getClientOriginalExtension();
            Storage::disk('reports')->put($attachSatResultName, \File::get($testReport));
            $add_additional_test->patient_report_pdf = $attachSatResultName;
        }
        $add_additional_test->save();
        session()->put("branch_additional_report_created",true);
        $branch_details = VendorBranch::where('id', auth()->user()->branch_id)->first();
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => $branch_details->branch_slug, 'create' => 'branch_additional_report']);
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
    // public function destroy($id)
    // {
    // }
    public function delete($id)
    {
        AddTestReport::find($id)->delete();
        session()->put("branch_additional_report_deleted",true);
        $branch_details = VendorBranch::where('id', auth()->user()->branch_id)->first();
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => $branch_details->branch_slug, 'create' => 'branch_additional_report']);
    }
}
