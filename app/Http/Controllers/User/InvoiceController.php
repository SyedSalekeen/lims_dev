<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AddTest;
use App\AddTestReport;
use App\User;
use App\VendorBranch;
use App\Patient;
use App\TestGig;
use Mail;
use App\AddTestDetail;
use App\LabTest;
use App\User\AddTestReportDetail;
use Illuminate\Support\Facades\Crypt;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branch_details = VendorBranch::where('id', auth()->user()->branch_id)->first();
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => $branch_details->branch_slug, 'create' => 'patient_invoice']);

        // $get_auth_user = User::find(auth()->id());
        // $add_test = AddTest::where('vendor_id',$get_auth_user->vendor_id)->where('branch_id',$get_auth_user->branch_id)->get();
        // return view('user.invoice_report.index',get_defined_vars());
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
        // dd($request->all());
        $get_patient = User::find($request->patient_id);
        $request->validate([
            "test_result.*" => "required",
        ]);

        $labTestIds= $request->lab_test_ids;
        foreach ($labTestIds as $item) {
            $getGigName = LabTest::find($item);
            $gigName[] = $getGigName->lab_test_name;
        }
        $collection = collect($gigName);
        $labTestNames = $collection->implode(', ', ', ');

        $ids = [];
        $countRange = 0;
        $countValue = 0;
        $countValueTwo = 0;
        $get_auth_user = User::find(auth()->id());
        $get_branch_name = VendorBranch::find($get_auth_user->branch_id);
        $store_report = new AddTestReport();
        $store_report->vendor_id = $get_auth_user->vendor_id;
        $store_report->branch_vendor_id = auth()->id();
        $store_report->invoice_id = $request->invoice_id;
        $store_report->branch_id = $get_auth_user->branch_id;
        $store_report->patient_id = $request->patient_id;
        $store_report->age = $get_patient->age;
        $store_report->laboratory_name = $get_auth_user->laboratory_name;
        $store_report->lab_test_name = $labTestNames;
        $store_report->patient_name = $request->patient_name;
        $store_report->branch_name = $get_branch_name->branch_name;
        $store_report->save();
        $change_report_status = AddTest::find($request->invoice_id);
        $change_report_status->report_status = "1";
        $change_report_status->save();
        session()->put("test_resport_id", $store_report->id);

        foreach ($request->test_name as $item) {
            $store_report_name = new AddTestReportDetail();
            $store_report_name->test_report_id = session()->get('test_resport_id');
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
        session()->put('branch_report_created',true);
        $branch_details = VendorBranch::where('id', auth()->user()->branch_id)->first();
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => $branch_details->branch_slug, 'create' => 'branch_patient_report']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {



        // $branch_details = VendorBranch::where('id', auth()->user()->branch_id)->first();
        // return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => $branch_details->branch_slug, 'create' => 'branch_invoice', 'id' => $id]);
        // dd($id);
        $branch_details = VendorBranch::where('id', auth()->user()->branch_id)->first();
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => $branch_details->branch_slug, 'create' => 'patient_invoice_show', 'id' => $id]);
        // $invoice = AddTest::find($id);
        // $get_logo = User::find($invoice->vendor_id);
        // $branch_name = VendorBranch::find($invoice->branch_id);
        // $patient_name = Patient::find($invoice->patient_mr_no);
        // return view('user.invoice_report.invoice',get_defined_vars());

    }
    public function patient_invoice_show(Request $request)
    {
        $getTestDetials = AddTestDetail::where("add_test_id", $request->id)
            ->has('get_gig_name')
            ->with('get_gig_name')
            ->get();
        $getTest = AddTest::find($request->id);
        $get_laoratory_name = User::find($getTest->vendor_id);
        $get_branch_name = VendorBranch::find($getTest->branch_id);
        $get_patient = User::find($getTest->patient_mr_no);


        $QrCode = QrCode::generate($get_branch_name->branch_url);
        $QrCodeSvg = substr($QrCode, 39);
        $QrCodeHTML = '<img src="data:image/svg+xml;base64,'.base64_encode($QrCodeSvg).'"width="100" height="100"/>';


        return ["data" => $getTestDetials, "getTest" => $getTest, "get_laoratory_name" => $get_laoratory_name, "get_branch_name" => $get_branch_name, "get_patient" => $get_patient,"QrCodeHTML" => $QrCodeHTML];
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        $branch_details = VendorBranch::where('id', auth()->user()->branch_id)->first();
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => $branch_details->branch_slug, 'create' => 'patient_report_create', 'id' => $id]);
        // $invoice = AddTest::find($id);
        // $get_range = TestGig::find($invoice->patient_test_name_id);
        // $get_logo = User::find($invoice->vendor_id);
        // $branch_name = VendorBranch::find($invoice->branch_id);
        // $patient_name = Patient::find($invoice->patient_mr_no);
        // return view('user.invoice_report.report',get_defined_vars());
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
    public function patient_invoice_delete($id)
    {
        AddTest::find($id)->delete();
        AddTestDetail::where('add_test_id', $id)->delete();
        session()->put('branch_invoice_delete', true);
        $branch_details = VendorBranch::where('id', auth()->user()->branch_id)->first();
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => $branch_details->branch_slug, 'create' => 'patient_invoice']);
    }
}
