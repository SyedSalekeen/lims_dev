<?php

namespace App\Http\Controllers\User;

use App\AddTest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\VendorBranch;
use App\User;
use App\AddTestDetail;
use App\AddTestReport;
use App\TestGig;
use App\User\AddTestReportDetail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BranchAddTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branch_details = VendorBranch::where('id', auth()->user()->branch_id)->first();
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => $branch_details->branch_slug, 'create' => 'branch_add_test']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branch_details = VendorBranch::where('id', auth()->user()->branch_id)->first();
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => $branch_details->branch_slug, 'create' => 'branch_add_test_create']);
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
        $data = $request->all();
        session()->put("branch_test_data", $data);
        $total_amount = 0;
        $ii = $request->actual_amont;
        for ($i = 0; $i < count($ii); $i++) {
            $total_amount += $ii[$i];
        }
        $get_auth_user = User::find(auth()->id());
        $add_test = new AddTest();
        $add_test->vendor_id = $get_auth_user->vendor_id;
        $add_test->branch_vendor_id = auth()->id();
        $add_test->branch_id = $get_auth_user->branch_id;
        $add_test->booking_time = $request->time;
        $add_test->booking_date = $request->date;
        $add_test->patient_mr_no = $request->patient_mr_number;
        $add_test->total_test_amount = $total_amount;
        $add_test->save();
        $getData = $add_test::find($add_test->id);
        session()->put("branch_add_test_id", $getData->id);
        return ["success" => $getData];

        // $get_auth_user = User::find(auth()->id());
        // $this->validate($request, [
        //     'patient_mr_number' => 'required',
        //     'report_issue_date' => 'required',
        //     'test_amount' => 'required',
        // ]);
        // $add_test = new AddTest();
        // $add_test->vendor_id = $get_auth_user->vendor_id;
        // $add_test->branch_vendor_id = auth()->id();
        // $add_test->branch_id = $get_auth_user->branch_id;
        // $add_test->patient_mr_no = $request->patient_mr_number;
        // $add_test->patient_test_name = $request->patient_test_name;
        // $add_test->patient_test_name_id = $request->patient_test_name_id;
        // $add_test->report_issue_date = $request->report_issue_date;
        // $add_test->test_amount = $request->test_amount;
        // $add_test->test_notes = $request->test_notes;
        // $add_test->test_discount_amount = $request->test_discount_amount;
        // $add_test->additional_discount_amount = $request->additional_discount_amount;
        // $add_test->total_test_amount = $request->total_test_amount;
        // $add_test->save();
        // session()->put('branch_test_add', true);
        // return redirect()->route('branch_add_test.index')
        //     ->with('success', 'User created successfully');
    }
    public function add_test_payemnet(Request $request)
    {
        // dd($request->all());
        $add_payment = AddTest::find(session()->get('branch_add_test_id'));
        $add_payment->after_dicount_amount = $request->after_dicount_calculated;
        $add_payment->discount = $request->discount;
        $add_payment->gst = $request->gst_amount;
        $add_payment->amount = $request->total_amount;
        $add_payment->save();
        return ["success" => $add_payment];
    }

    public function payement_submit(Request $request)
    {
        // dd($request->all());
        $count = 0;
        $countAmount = 0;
        $data = session()->get('branch_test_data');
        $ids = [];

        foreach ($data['gig_id'] as $item) {
            $testDetailsGig = new AddTestDetail();
            $testDetailsGig->add_test_id = session()->get('branch_add_test_id');
            $testDetailsGig->gig_id = $item;
            $testDetailsGig->save();
            $id = $testDetailsGig->id;
            array_push($ids, $id);
        }
        foreach ($data['quantity'] as $item) {
            $testDetailsQty = AddTestDetail::find($ids[$count]);
            $testDetailsQty->gig_quantity = $item;
            $testDetailsQty->save();
            $count++;
        }
        foreach ($data['actual_amont'] as $item) {
            // return $data['actual_amont'];
            $testDetailsAmount = AddTestDetail::find($ids[$countAmount]);
            $testDetailsAmount->gig_amount = $item;
            $testDetailsAmount->save();
            $countAmount++;
        }
        if ($request->fav_language == "later") {
            $add_pay = AddTest::find(session()->get('branch_add_test_id'));
            $add_pay->payement_method = $request->fav_language;
            $add_pay->cash_given = "--";
            $add_pay->cash_remaining = "--";
            $add_pay->cash_return = "--";
            $add_pay->save();
        } else {
            $add_pay = AddTest::find(session()->get('branch_add_test_id'));
            $add_pay->payement_method = $request->fav_language;
            $add_pay->cash_given = $request->cash_given;
            $add_pay->cash_remaining = $request->cash_remaining;
            $add_pay->cash_return = $request->cash_return;
            $add_pay->save();
        }

        session()->put('branch_test_add', true);
        return redirect()->route('branch_add_test.index')
            ->with('success', 'User created successfully');
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
        $branch_details = VendorBranch::where('id', auth()->user()->branch_id)->first();
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => $branch_details->branch_slug, 'create' => 'branch_add_test_edit', 'id' => $id]);
    }

    public function editStore(Request $request)
    {
        // dd($request->all());
        $data = $request->all();
        session()->put("branch_test_data", $data);
        $total_amount = 0;
        $ii = $request->actual_amont;
        for ($i = 0; $i < count($ii); $i++) {
            $total_amount += $ii[$i];
        }
        $get_auth_user = User::find(auth()->id());
        $add_test = AddTest::find($request->BranchEdit_test_id);
        $add_test->vendor_id = $get_auth_user->vendor_id;
        $add_test->branch_vendor_id = auth()->id();
        $add_test->branch_id = $get_auth_user->branch_id;
        $add_test->booking_time = $request->time;
        $add_test->booking_date = $request->date;
        $add_test->patient_mr_no = $request->patient_mr_number;
        $add_test->total_test_amount = $total_amount;
        $add_test->save();
        $getData = $add_test::find($add_test->id);
        session()->put("branch_edit_test_id", $getData->id);
        return ["success" => $getData];
    }

    public function branch_edit_test_payemnet(Request $request)
    {
        $add_payment = AddTest::find(session()->get('branch_edit_test_id'));
        $add_payment->after_dicount_amount = $request->after_dicount_calculated;
        $add_payment->discount = $request->discount;
        $add_payment->gst = $request->gst_amount;
        $add_payment->amount = $request->total_amount;
        $add_payment->save();
        return ["success" => $add_payment];
    }

    public function branch_edit_payement_submit(Request $request)
    {
        // dd($request->all());
        AddTestDetail::where("add_test_id", session()->get('branch_edit_test_id'))->delete();
        $count = 0;
        $countAmount = 0;
        $data = session()->get('branch_test_data');
        $ids = [];
        AddTestDetail::where('add_test_id',$data['BranchEdit_test_id'])->delete();

        foreach ($data['gig_id'] as $item) {
            $testDetailsGig = new AddTestDetail();
            $testDetailsGig->add_test_id = session()->get('branch_edit_test_id');
            $testDetailsGig->gig_id = $item;
            $testDetailsGig->save();
            $id = $testDetailsGig->id;
            array_push($ids, $id);
        }
        foreach ($data['quantity'] as $item) {
            $testDetailsQty = AddTestDetail::find($ids[$count]);
            $testDetailsQty->gig_quantity = $item;
            $testDetailsQty->save();
            $count++;
        }
        foreach ($data['actual_amont'] as $item) {
            // return $data['actual_amont'];
            $testDetailsAmount = AddTestDetail::find($ids[$countAmount]);
            $testDetailsAmount->gig_amount = $item;
            $testDetailsAmount->save();
            $countAmount++;
        }
        if ($request->fav_language == "later") {
            $add_pay = AddTest::find(session()->get('branch_edit_test_id'));
            $add_pay->payement_method = "--";
            $add_pay->cash_given = "--";
            $add_pay->cash_remaining = "--";
            $add_pay->cash_return = "--";
            $add_pay->save();
        } else {
            $add_pay = AddTest::find(session()->get('branch_edit_test_id'));
            $add_pay->payement_method = $request->fav_language;
            $add_pay->cash_given = $request->cash_given;
            $add_pay->cash_remaining = $request->cash_remaining;
            $add_pay->cash_return = $request->cash_return;
            $add_pay->save();
        }

        session()->put('branch_edit_test_updated', true);
        return redirect()->route('branch_add_test.index')
            ->with('success', 'User created successfully');
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
        $this->validate($request, [
            'patient_mr_number' => 'required',
            'report_issue_date' => 'required',
            'test_amount' => 'required',
        ]);
        $add_test = AddTest::find($id);
        $add_test->patient_mr_no = $request->patient_mr_number;
        $add_test->patient_test_name = $request->patient_test_name;
        $add_test->patient_test_name_id = $request->patient_test_name_id;
        $add_test->report_issue_date = $request->report_issue_date;
        $add_test->test_amount = $request->test_amount;
        $add_test->test_notes = $request->test_notes;
        $add_test->test_discount_amount = $request->test_discount_amount;
        $add_test->additional_discount_amount = $request->additional_discount_amount;
        $add_test->total_test_amount = $request->total_test_amount;
        $add_test->save();
        session()->put('branch_test_updated', true);
        return redirect()->route('branch_add_test.index')
            ->with('success', 'User created successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
    public function branch_add_test_destroy($id)
    {
        AddTest::find($id)->delete();
        AddTestDetail::where('add_test_id', $id)->delete();
        session()->put('branch_test_deleted', true);
        $branch_details = VendorBranch::where('id', auth()->user()->branch_id)->first();
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => $branch_details->branch_slug, 'create' => 'branch_add_test']);
    }


    public function branch_search_patient(Request $request)
    {
        $get_auth_user = User::find(auth()->id());
        if ($request->ajax()) {
            $data = TestGig::where("test_name", 'like', '%' . $request->search . '%')
                ->where("vendor_id", $get_auth_user->vendor_id)
                ->get();
            if (count($data) > 0) {
                return ["data" => $data];
            } else {
                return ["data" => "No result found"];
            }
        }
    }

    public function create_invoice(Request $request)
    {
        // dd($request->id);
        $getTestDetials = AddTestDetail::where("add_test_id", $request->id)
            ->has('get_gig_name')
            ->with('get_gig_name')
            ->get();
        $getTest = AddTest::find($request->id);
        $get_laoratory_name = User::find($getTest->vendor_id);
        $get_branch_name = VendorBranch::find($getTest->branch_id);
        $get_patient = User::find($getTest->patient_mr_no);
        // $getTest = AddTest::where("id", $request->id)
        //     ->with('get_vendor_laboratary_name')
        //     ->has('get_vendor_laboratary_name')
        //     ->first();
        // dd($getTest);
        // dd($getTestDetials);

        $QrCode = QrCode::generate($get_branch_name->branch_url);
        $QrCodeSvg = substr($QrCode, 39);
        $QrCodeHTML = '<img src="data:image/svg+xml;base64,'.base64_encode($QrCodeSvg).'"width="100" height="100"/>';


        return ["data" => $getTestDetials, "getTest" => $getTest, "get_laoratory_name" => $get_laoratory_name, "get_branch_name" => $get_branch_name, "get_patient" => $get_patient,"QrCodeHTML" => $QrCodeHTML];

        // $branch_details = VendorBranch::where('id', auth()->user()->branch_id)->first();
        // return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => $branch_details->branch_slug, 'create' => 'branch_invoice', 'id' => $id]);
        // dd($id);
    }
}
