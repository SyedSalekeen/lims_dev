<?php

namespace App\Http\Controllers\Vendor;

use App\AddTest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Patient;
use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\AddTestDetail;


class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "patient_index"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "patient_create"]);
        // return view('vendor.patient.create');
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
        $get_auth_user = User::find(auth()->id());
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'branch' => 'required',
            'martial_status' => 'required',
            'username' => 'required',
            'password' => 'required|same:confirm-password',
            'country' => 'required',
            'contact_number' => 'required|max:11',
            'age' => 'required',
            'city' => 'required',
            'state' => 'required',
            'address' => 'required',
            'zip_code' => 'required',
            'home_phone' => 'max:11',
        ]);

        $storing_patient_info = new User();
        $storing_patient_info->vendor_id = auth()->id();
        $storing_patient_info->branch_id = $request->branch;
        $storing_patient_info->first_name = $request->first_name;
        $storing_patient_info->last_name = $request->last_name;
        $storing_patient_info->fullname = $request->first_name . ' ' . $request->last_name;
        $storing_patient_info->sex = $request->gender;
        $storing_patient_info->martial_status = $request->martial_status;
        $storing_patient_info->patient_email = $request->username;
        $storing_patient_info->password = Hash::make($request->password);
        $storing_patient_info->patient_password = $request->password;
        $storing_patient_info->contact_number = $request->contact_number;
        $storing_patient_info->age = $request->age;
        $storing_patient_info->country = $request->country;
        $storing_patient_info->type = "6";
        $storing_patient_info->city = $request->city;
        $storing_patient_info->state = $request->state;
        $storing_patient_info->address = $request->address;
        $storing_patient_info->zip_code = $request->zip_code;
        $storing_patient_info->emergency_name = $request->emergency_name;
        $storing_patient_info->relationship = $request->relationship;
        $storing_patient_info->laboratory_slug = Auth::user()->laboratory_slug;
        $storing_patient_info->home_phone = $request->home_phone;
        $storing_patient_info->laboratory_name = $get_auth_user->laboratory_name;
        $storing_patient_info->save();
        $storing_email = User::find($storing_patient_info->id);
        $storing_email->email = $storing_patient_info->id;
        $storing_email->save();
        session()->put('patient_created', true);
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "patient_index"]);
    }

    public function patient_store_invoice(Request $request)
    {
        // dd($request->all());
        $checkPatientExist = User::where('patient_email', $request->username)->where('branch_id', $request->branch)->first();
        if ($checkPatientExist) {

            $checkPatient = User::find($checkPatientExist->id);
            $checkPatient->branch_id = $request->branch;
            $checkPatient->first_name = $request->first_name;
            $checkPatient->last_name = $request->last_name;
            $checkPatient->fullname = $request->first_name . ' ' . $request->last_name;
            $checkPatient->sex = $request->gender;
            $checkPatient->martial_status = $request->martial_status;
            $checkPatient->patient_email = $request->username;
            $checkPatient->password = Hash::make($request->password);
            $checkPatient->patient_password = $request->password;
            $checkPatient->contact_number = $request->contact_number;
            $checkPatient->age = $request->age;
            $checkPatient->country = $request->country;
            $checkPatient->type = "6";
            $checkPatient->city = $request->city;
            $checkPatient->state = $request->state;
            $checkPatient->address = $request->address;
            $checkPatient->zip_code = $request->zip_code;
            $checkPatient->emergency_name = $request->emergency_name;
            $checkPatient->relationship = $request->relationship;
            $checkPatient->laboratory_slug = Auth::user()->laboratory_slug;
            $checkPatient->home_phone = $request->home_phone;
            $checkPatient->save();
            $storing_email_check = User::find($checkPatient->id);
            $storing_email_check->email = $checkPatient->id;
            $storing_email_check->save();
            $findPatient = User::find($checkPatient->id);
            return ["data" => $findPatient, "success" => "true"];
        } else {
            $storing_patient_info = new User();
            $storing_patient_info->vendor_id = auth()->id();
            $storing_patient_info->branch_id = $request->branch;
            $storing_patient_info->first_name = $request->first_name;
            $storing_patient_info->last_name = $request->last_name;
            $storing_patient_info->fullname = $request->first_name . ' ' . $request->last_name;
            $storing_patient_info->sex = $request->gender;
            $storing_patient_info->martial_status = $request->martial_status;
            $storing_patient_info->patient_email = $request->username;
            $storing_patient_info->password = Hash::make($request->password);
            $storing_patient_info->patient_password = $request->password;
            $storing_patient_info->contact_number = $request->contact_number;
            $storing_patient_info->age = $request->age;
            $storing_patient_info->country = $request->country;
            $storing_patient_info->type = "6";
            $storing_patient_info->city = $request->city;
            $storing_patient_info->state = $request->state;
            $storing_patient_info->address = $request->address;
            $storing_patient_info->zip_code = $request->zip_code;
            $storing_patient_info->emergency_name = $request->emergency_name;
            $storing_patient_info->relationship = $request->relationship;
            $storing_patient_info->laboratory_slug = Auth::user()->laboratory_slug;
            $storing_patient_info->home_phone = $request->home_phone;
            $storing_patient_info->save();
            $storing_email = User::find($storing_patient_info->id);
            $storing_email->email = $storing_patient_info->id;
            $storing_email->save();
            $findPatient = User::find($storing_patient_info->id);
            return ["data" => $findPatient, "success" => "true"];
        }
    }
    public function patient_add_test(Request $request)
    {
        // dd($request->all());
        $data = $request->all();
        session()->put("patient_test_data", $data);
        $total_amount = 0;
        $ii = $request->actual_amont;
        for ($i = 0; $i < count($ii); $i++) {
            $total_amount += $ii[$i];
        }
        // dd($total_amount);
        $add_test = new AddTest();
        $add_test->vendor_id = auth()->id();
        $add_test->branch_id = $request->branch_id;
        $add_test->booking_time = $request->time;
        $add_test->booking_date = $request->date;
        $add_test->patient_mr_no = $request->patient_id;
        $add_test->total_test_amount = $total_amount;
        $add_test->save();
        $getData = $add_test::find($add_test->id);
        session()->put("patient_add_test_id", $getData->id);
        return ["success" => $getData];
    }

    public function patient_add_test_payement(Request $request)
    {
        // dd($request->all());
        $add_payment = AddTest::find(session()->get('patient_add_test_id'));
        $add_payment->after_dicount_amount = $request->after_dicount_calculated;
        $add_payment->discount = $request->discount;
        $add_payment->gst = $request->gst_amount;
        $add_payment->amount = $request->total_amount;
        $add_payment->save();
        return ["success" => $add_payment];
    }

    public function patient_payement_submit(Request $request)
    {
        $count = 0;
        $countAmount = 0;
        $data = session()->get('patient_test_data');
        $ids = [];

        foreach ($data['gig_id'] as $item) {
            $testDetailsGig = new AddTestDetail();
            $testDetailsGig->add_test_id = session()->get('patient_add_test_id');
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
            $add_pay = AddTest::find(session()->get('patient_add_test_id'));
            $add_pay->payement_method = $request->fav_language;
            $add_pay->cash_given = "--";
            $add_pay->cash_remaining = "--";
            $add_pay->cash_return = "--";
            $add_pay->save();
        } else {
            $add_pay = AddTest::find(session()->get('patient_add_test_id'));
            $add_pay->payement_method = $request->fav_language;
            $add_pay->cash_given = $request->cash_given;
            $add_pay->cash_remaining = $request->cash_remaining;
            $add_pay->cash_return = $request->cash_return;
            $add_pay->save();
        }

        session()->put('patient_and_invoice_created', true);
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "patient_index"]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'patient_id' => $id, 'requestpath' => "show_patient"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'patient_id' => $id, 'requestpath' => "patient_edit"]);
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
            'first_name' => 'required',
            'last_name' => 'required',
            'branch' => 'required',
            'gender' => 'required',
            'martial_status' => 'required',
            'country' => 'required',
            'contact_number' => 'required|max:11',
            'age' => 'required',
            'city' => 'required',
            'state' => 'required',
            'address' => 'required',
            'home_phone' => 'max:11',
        ]);
        // dd($request->all());
        $storing_patient_info = User::find($id);
        $storing_patient_info->vendor_id = auth()->id();
        $storing_patient_info->branch_id = $request->branch;
        $storing_patient_info->first_name = $request->first_name;
        $storing_patient_info->last_name = $request->last_name;
        $storing_patient_info->fullname = $request->first_name . ' ' . $request->last_name;
        $storing_patient_info->sex = $request->gender;
        $storing_patient_info->martial_status = $request->martial_status;
        if ($request->password) {
            $storing_patient_info->password = Hash::make($request->password);
            $storing_patient_info->patient_password = $request->password;
        }
        $storing_patient_info->contact_number = $request->contact_number;
        $storing_patient_info->age = $request->age;
        $storing_patient_info->country = $request->country;
        $storing_patient_info->city = $request->city;
        $storing_patient_info->state = $request->state;
        $storing_patient_info->address = $request->address;
        $storing_patient_info->zip_code = $request->zip_code;
        $storing_patient_info->emergency_name = $request->emergency_name;
        $storing_patient_info->relationship = $request->relationship;
        $storing_patient_info->home_phone = $request->home_phone;
        
        $storing_patient_info->save();
        session()->put('patient_updated', true);
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "patient_index"]);
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
    public function patient_destroy_delete($id)
    {
        $patient_status_off = User::where('id', $id)->delete();
        session()->put('patient_deleted', true);
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "patient_index"]);
    }
    public function patient_filter(Request $request)
    {
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "patient_filter", "name" => $request->patient_name, "mr" => $request->patient_mr, "id" => $request->branch_name]);
        // $this->validate($request, [
        //     'branch_name' => 'required',
        // ]);
        // if ($request->branch_name) {
        //     $get_patient = User::where("branch_id", $request->branch_name)->where("type", "6")->get();
        // }
        // if($request->branch_name && $request->patient_mr){
        //     $get_patient = User::where("email", $request->patient_mr)->get();
        // }
        // if($request->branch_name && $request->patient_name){
        //     $get_patient = User::where("fullname", $request->patient_name)->where("branch_id", $request->branch_name)->where("type","6")->get();
        // }
    }
}
