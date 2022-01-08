<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\AddTest;
use App\AddTestDetail;
use App\TestGig;
use App\VendorBranch;
use App\User\AddTestReportDetail;
use App\AddTestReport;
use Mail;
use App\LabTest;

class VendorAddReport extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "vendor_add_report"]);
        $get_auth_user = User::find(auth()->id());
        $add_test = AddTest::where('vendor_id', $get_auth_user->id)->get();
        return view('vendor.add_report.index', get_defined_vars());
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
        $labTestIds= $request->lab_test_ids;
        foreach ($labTestIds as $item) {
            $getGigName = LabTest::find($item);
            $gigName[] = $getGigName->lab_test_name;
        }
        $collection = collect($gigName);
        $labTestNames = $collection->implode(', ', ', ');

        $get_patient = User::find($request->patient_id);
        $request->validate([
            "test_result.*" => "required",
        ]);
        $ids = [];
        $countRange = 0;
        $countValue = 0;
        $countValueTwo = 0;
        $get_auth_user = User::find(auth()->id());

        $get_branch_name = VendorBranch::find($get_patient->branch_id);
        $store_report = new AddTestReport();
        $store_report->vendor_id = auth()->id();
        $store_report->branch_vendor_id = $get_branch_name->id;
        $store_report->branch_id = $get_branch_name->id;
        $store_report->patient_id = $request->patient_id;
        $store_report->invoice_id = $request->invoice_id;
        $store_report->lab_test_name = $labTestNames;
        $store_report->age = $get_patient->age;
        $store_report->laboratory_name = $get_auth_user->laboratory_name;
        $store_report->patient_name = $request->patient_name;
        $store_report->branch_name = $get_branch_name->branch_name;
        $store_report->save();
        $change_report_status = AddTest::find($request->invoice_id);
        $change_report_status->report_status = "1";
        $change_report_status->save();
        session()->put("vendor_test_resport_id", $store_report->id);

        foreach ($request->test_name as $item) {
            $store_report_name = new AddTestReportDetail();
            $store_report_name->test_report_id = session()->get('vendor_test_resport_id');
            $store_report_name->test_name = $item;
            $store_report_name->save();
            $id = $store_report_name->id;
            array_push($ids, $id);
        }
        foreach ($request->test_best_range as $item) {
            $store_report_range = AddTestReportDetail::find($ids[$countRange]);
            $store_report_range->test_best_range = $item;
            $store_report_range->save();
            $countRange++;
        }
        foreach ($request->test_result as $item) {
            $store_report_result = AddTestReportDetail::find($ids[$countValue]);
            $store_report_result->test_result = $item;
            $store_report_result->save();
            $countValue++;
        }
        foreach ($request->test_unit as $item) {
            $store_report_result = AddTestReportDetail::find($ids[$countValueTwo]);
            $store_report_result->test_unit = $item;
            $store_report_result->save();
            $countValueTwo++;
        }

        session()->put('Report created and sent to the patient', true);
        $emailToSend = $get_patient->patient_email;
        $token = sha1(uniqid(time(), true));
        $get_branch_url = VendorBranch::find($get_patient->branch_id);
        session()->put("patient_branch_login_url", $get_branch_url->branch_url);
        session()->put("patient_login_mr_id", $request->patient_id);
        session()->put("patient_login_password", $get_patient->patient_password);
        Mail::send('user.mail.report_mail', ['data' => route('patient_invoice.index', ['token' => $token])], function ($messages) use ($emailToSend) {
            $messages->to($emailToSend);
            $messages->subject('Test Report');
        });
        session()->put('vendor_test_report_created',true);
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "test_report"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "vendor_create_report",'id'=>$id]);

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
    public function vendor_add_report_destroy_delete($id){
        AddTest::find($id)->delete();
        AddTestDetail::where('add_test_id',$id)->delete();
        session()->put('vendor_add_report_deleted',true);
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "vendor_add_report"]);
    }
}
