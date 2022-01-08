<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\VendorBranch;
use PDF;
use App\AddTestReport;
use App\AddTest;
use App\User;

class PatientReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branch_details = VendorBranch::where('id', auth()->user()->branch_id)->first();
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => $branch_details->branch_slug, 'create' => 'patient_report']);
        // return view('patient.reports.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $branch_details = VendorBranch::where('id', auth()->user()->branch_id)->first();
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => $branch_details->branch_slug, 'create' => 'patient_report_show','id'=>$id]);
        // $invoice = AddTest::find($id);
        // $get_logo = User::find($invoice->vendor_id);
        // $branch_name = VendorBranch::find($invoice->branch_id);
        // $patient_name = User::find($invoice->patient_mr_no);
        // $showreport = AddTestReport::find($id);
        // $pdf = PDF::loadView('patient.reports.report_pdf', get_defined_vars());
        // return $pdf->stream('ducument.pdf');
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
}
