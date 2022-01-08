<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Patient;
use App\TestGig;
use Illuminate\Http\Request;
use App\VendorBranch;
use App\AddTest;
use App\AddTestDetail;
use App\LabTest;
use App\User;
use SebastianBergmann\Environment\Console;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AddTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "add_test"]);
        // return view('vendor.add_test.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_test_gig_amount(Request $request)
    {
        // return ["data" => $request->all()];
        $get_test_amount = TestGig::find($request->id);
        return ["data" => $get_test_amount];
    }
    public function create()
    {
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "test_create"]);
        // $get_vendor_branch = VendorBranch::where('vendor_id', auth()->id())->where('delete_status', '0')->where('status', '1')->get();
        // $get_patients = Patient::where('vendor_id',auth()->id())->get();
        // $get_test_gigs = TestGig::where('vendor_id',auth()->id())->get();
        // return view('vendor.add_test.create',get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        session()->put("test_data", $data);
        $total_amount = 0;
        $ii = $request->actual_amont;
        for ($i = 0; $i < count($ii); $i++) {
            $total_amount += $ii[$i];
        }
        // dd($total_amount);
        $add_test = new AddTest();
        $add_test->vendor_id = auth()->id();
        $add_test->branch_id = $request->branch;
        $add_test->booking_time = $request->time;
        $add_test->booking_date = $request->date;
        $add_test->patient_mr_no = $request->patient_mr_number;
        $add_test->total_test_amount = $total_amount;
        $add_test->save();
        $getData = $add_test::find($add_test->id);
        session()->put("add_test_id", $getData->id);
        return ["success" => $getData];


        // $name = 'BPV' . ' ' . $request->crv_no . ' ' . $request->reference . ' ' . date('d-M-Y')
        //     . ' ' . $request->customer_name . ' ' . $request->receive_amount;
        // $QrCode = QrCode::generate($name);
        // $QrCodeSvg = substr($QrCode, 39);
        // $QrCodeHTML = '<img src="data:image/svg+xml;base64,' . base64_encode($QrCodeSvg) . '"width="75" height="75" "/>';
    }


    public function add_test_payemnet(Request $request)
    {
        // dd($request->all());
        $add_payment = AddTest::find(session()->get('add_test_id'));
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
        $data = session()->get('test_data');
        // return $data;
        $gig_id = $data['gig_id'];
        $quantity = $data['quantity'];
        $actual_amont = $data['actual_amont'];
        $ids = [];

        foreach ($data['gig_id'] as $item) {
            $testDetailsGig = new AddTestDetail();
            $testDetailsGig->add_test_id = session()->get('add_test_id');
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
            $add_pay = AddTest::find(session()->get('add_test_id'));
            $add_pay->payement_method = $request->fav_language;
            $add_pay->cash_given = "--";
            $add_pay->cash_remaining = "--";
            $add_pay->cash_return = "--";
            $add_pay->save();
        } else {
            $add_pay = AddTest::find(session()->get('add_test_id'));
            $add_pay->payement_method = $request->fav_language;
            $add_pay->cash_given = $request->cash_given;
            $add_pay->cash_remaining = $request->cash_remaining;
            $add_pay->cash_return = $request->cash_return;
            $add_pay->save();
        }

        session()->put('vendor_test_add', true);
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "add_test"]);
    }


    public function edit_invoice(Request $request)
    {
        return ["id" => $request->id];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "test_show", 'id' => $id]);
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
        session()->put("edit_id", $id);
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "test_edit", 'id' => $id]);
    }

    public function edit_test_store(Request $request)
    {
        // return ["data" => "true"];
        // dd($request->all());
        $data = $request->all();
        session()->put("test_data", $data);
        $total_amount = 0;
        $ii = $request->actual_amont;
        // dd($request->actual_amont);
        for ($i = 0; $i < count($ii); $i++) {
            $total_amount += $ii[$i];
        }
        // dd($total_amount);
        $add_test = AddTest::find($request->AddTestId);
        // dd($add_test->total_test_amount);
        $add_test->branch_id = $request->branch;
        $add_test->booking_time = $request->time;
        $add_test->booking_date = $request->date;
        $add_test->patient_mr_no = $request->patient_mr_number;
        $add_test->total_test_amount = $total_amount;

        $add_test->save();
        $getData = $add_test::find($add_test->id);
        session()->put("edit_add_test_id", $getData->id);
        return ["success" => $getData];
    }

    public function edit_test_payement(Request $request)
    {
        $add_payment = AddTest::find(session()->get('edit_add_test_id'));
        $add_payment->after_dicount_amount = $request->after_dicount_calculated;
        $add_payment->discount = $request->discount;
        $add_payment->gst = $request->gst_amount;
        $add_payment->amount = $request->total_amount;
        $add_payment->save();
        return ["success" => $add_payment];
    }
    public function edit_payement_submit(Request $request)
    {

        AddTestDetail::where("add_test_id", session()->get('edit_add_test_id'))->delete();
        $count = 0;
        $countAmount = 0;
        $data = session()->get('test_data');
        AddTestDetail::where('add_test_id', $data['AddTestId'])->delete();
        $gig_id = $data['gig_id'];
        $quantity = $data['quantity'];
        $actual_amont = $data['actual_amont'];
        $ids = [];

        foreach ($data['gig_id'] as $item) {
            $testDetailsGig = new AddTestDetail();
            $testDetailsGig->add_test_id = session()->get('edit_add_test_id');
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
            $add_pay = AddTest::find(session()->get('edit_add_test_id'));
            $add_pay->payement_method = "--";
            $add_pay->cash_given = "--";
            $add_pay->cash_remaining = "--";
            $add_pay->cash_return = "--";
            $add_pay->save();
        } else {
            $add_pay = AddTest::find(session()->get('edit_add_test_id'));
            $add_pay->payement_method = $request->fav_language;
            $add_pay->cash_given = $request->cash_given;
            $add_pay->cash_remaining = $request->cash_remaining;
            $add_pay->cash_return = $request->cash_return;
            $add_pay->save();
        }

        session()->put('vendor_test_updated', true);
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "add_test"]);
    }

    public function edit_test_delete($id)
    {
        // dd($id);
        $edit_id = session()->get("edit_id");
        AddTestDetail::find($id)->delete();
        session()->put('edit_test_delete', true);
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "test_edit", 'id' => $edit_id]);
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
        // dd($request->all());
        $this->validate($request, [
            'patient_mr_number' => 'required',
            'report_issue_date' => 'required',
            'test_amount' => 'required',
            'branch' => 'required',
        ]);
        $add_test = AddTest::find($id);
        $add_test->branch_id = $request->branch;
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
        session()->put('vendor_test_updated', true);
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "add_test"]);
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
    public function add_test_destroy_delete($id)
    {
        AddTest::find($id)->delete();
        $add_test_detail = AddTestDetail::where('add_test_id', $id)->delete();
        session()->put('vendor_test_deleted', true);
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "add_test"]);
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
        $QrCodeHTML = '<img src="data:image/svg+xml;base64,' . base64_encode($QrCodeSvg) . '"width="100" height="100"/>';


        return ["data" => $getTestDetials, "getTest" => $getTest, "get_laoratory_name" => $get_laoratory_name, "get_branch_name" => $get_branch_name, "get_patient" => $get_patient, "QrCodeHTML" => $QrCodeHTML];
    }
    public function search_patient(Request $request)
    {
        if ($request->ajax()) {
            $data = TestGig::where("test_name", 'like', '%' . $request->search . '%')
                ->where("vendor_id", auth()->id())
                ->get();
            if (count($data) > 0) {
                return ["data" => $data];
            } else {
                return ["data" => "No result found"];
            }
        }
    }

    public function vendor_add_gig_to_invoice(Request $request)
    {
        $get_gig = TestGig::find($request->id);
        return ["gig_data" => $get_gig];
    }
}
