<?php

namespace App\Http\Controllers\User;

use App\AddTest;
use App\AddTestDetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Patient;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Vendor\PermissionId;
use App\Vendor\RolePermission;
use App\VendorBranch;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branch_details = VendorBranch::where('id', auth()->user()->branch_id)->first();
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => $branch_details->branch_slug, 'create' => 'branch_patient']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branch_details = VendorBranch::where('id', auth()->user()->branch_id)->first();
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => $branch_details->branch_slug, 'create' => 'branch_patient_create']);
        // return view('user.patient.create');
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
            'martial_status' => 'required',
            'username' => 'required',
            'password' => 'required|same:confirm-password',
            'country' => 'required',
            'contact_number' => 'required|max:11',
            'age' => 'required',
            'zip_code' => 'required',
            'city' => 'required',
            'state' => 'required',
            'address' => 'required',
            'home_phone' => 'max:11',
        ]);

        $storing_patient_info = new User();
        $storing_patient_info->vendor_id = $get_auth_user->vendor_id;
        $storing_patient_info->vendor_branch_id = auth()->id();
        $storing_patient_info->branch_id = $get_auth_user->branch_id;
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
        $storing_patient_info->laboratory_slug = Auth::user()->laboratory_slug;
        $storing_patient_info->city = $request->city;
        $storing_patient_info->state = $request->state;
        $storing_patient_info->address = $request->address;
        $storing_patient_info->zip_code = $request->zip_code;
        $storing_patient_info->emergency_name = $request->emergency_name;
        $storing_patient_info->relationship = $request->relationship;
        $storing_patient_info->home_phone = $request->home_phone;
        $storing_patient_info->save();
        $storing_email = User::find($storing_patient_info->id);
        $storing_email->email = $storing_patient_info->id;
        $storing_email->save();
        session()->put('branch_patient_create', true);
        return redirect()->route('branch_patient.index')
            ->with('success', 'Patient created successfully');
    }
    public function store_create_invoice(Request $request)
    {
        $get_auth_user = User::find(auth()->id());

        $checkPatientExist = User::where('patient_email', $request->username)->where('branch_id', $get_auth_user->branch_id)->first();
        // dd($checkPatientExist);
        if ($checkPatientExist) {

            $storing_patient_info_update = User::find($checkPatientExist->id);
            $storing_patient_info_update->vendor_id = $get_auth_user->vendor_id;
            $storing_patient_info_update->vendor_branch_id = auth()->id();
            $storing_patient_info_update->branch_id = $get_auth_user->branch_id;
            $storing_patient_info_update->first_name = $request->first_name;
            $storing_patient_info_update->last_name = $request->last_name;
            $storing_patient_info_update->fullname = $request->first_name . ' ' . $request->last_name;
            $storing_patient_info_update->sex = $request->gender;
            $storing_patient_info_update->martial_status = $request->martial_status;
            $storing_patient_info_update->patient_email = $request->username;
            $storing_patient_info_update->password = Hash::make($request->password);
            $storing_patient_info_update->patient_password = $request->password;
            $storing_patient_info_update->contact_number = $request->contact_number;
            $storing_patient_info_update->age = $request->age;
            $storing_patient_info_update->country = $request->country;
            $storing_patient_info_update->type = "6";
            $storing_patient_info_update->laboratory_slug = Auth::user()->laboratory_slug;
            $storing_patient_info_update->city = $request->city;
            $storing_patient_info_update->state = $request->state;
            $storing_patient_info_update->address = $request->address;
            $storing_patient_info_update->zip_code = $request->zip_code;
            $storing_patient_info_update->emergency_name = $request->emergency_name;
            $storing_patient_info_update->relationship = $request->relationship;
            $storing_patient_info_update->home_phone = $request->home_phone;
            $storing_patient_info_update->save();
            $storing_email_update = User::find($storing_patient_info_update->id);
            $storing_email_update->email = $storing_patient_info_update->id;
            $storing_email_update->save();
            $get_patient_data = User::find($storing_patient_info_update->id);
            return ["data" => $get_patient_data];
        } else{

            $storing_patient_info = new User();
            $storing_patient_info->vendor_id = $get_auth_user->vendor_id;
            $storing_patient_info->vendor_branch_id = auth()->id();
            $storing_patient_info->branch_id = $get_auth_user->branch_id;
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
            $storing_patient_info->laboratory_slug = Auth::user()->laboratory_slug;
            $storing_patient_info->city = $request->city;
            $storing_patient_info->state = $request->state;
            $storing_patient_info->address = $request->address;
            $storing_patient_info->zip_code = $request->zip_code;
            $storing_patient_info->emergency_name = $request->emergency_name;
            $storing_patient_info->relationship = $request->relationship;
            $storing_patient_info->home_phone = $request->home_phone;
            $storing_patient_info->save();
            $storing_email = User::find($storing_patient_info->id);
            $storing_email->email = $storing_patient_info->id;
            $storing_email->save();
            $get_patient_data = User::find($storing_patient_info->id);
            return ["data" => $get_patient_data];
        }

    }

    public function branch_patient_invoice(Request $request)
    {
        // dd($request->all());
        $data = $request->all();
        session()->put("branch_patient_test_data", $data);
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
        $add_test->patient_mr_no = $request->patient_id;
        $add_test->total_test_amount = $total_amount;
        $add_test->save();
        $getData = $add_test::find($add_test->id);
        session()->put("branch_patient_add_test_id", $getData->id);
        return ["success" => $getData];
    }
    public function branch_patient_test_payement(Request $request)
    {
        $add_payment = AddTest::find(session()->get('branch_patient_add_test_id'));
        $add_payment->after_dicount_amount = $request->after_dicount_calculated;
        $add_payment->discount = $request->discount;
        $add_payment->gst = $request->gst_amount;
        $add_payment->amount = $request->total_amount;
        $add_payment->save();
        return ["success" => $add_payment];
    }
    public function branch_patient_payement_submit(Request $request)
    {
        // dd($request->all());
        $count = 0;
        $countAmount = 0;
        $data = session()->get('branch_patient_test_data');
        $ids = [];

        foreach ($data['gig_id'] as $item) {
            $testDetailsGig = new AddTestDetail();
            $testDetailsGig->add_test_id = session()->get('branch_patient_add_test_id');
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
            $add_pay = AddTest::find(session()->get('branch_patient_add_test_id'));
            $add_pay->payement_method = $request->fav_language;
            $add_pay->cash_given = "--";
            $add_pay->cash_remaining = "--";
            $add_pay->cash_return = "--";
            $add_pay->save();
        } else {
            $add_pay = AddTest::find(session()->get('branch_patient_add_test_id'));
            $add_pay->payement_method = $request->fav_language;
            $add_pay->cash_given = $request->cash_given;
            $add_pay->cash_remaining = $request->cash_remaining;
            $add_pay->cash_return = $request->cash_return;
            $add_pay->save();
        }


        session()->put('branch_patient_invoice_has_created', true);
        $branch_details = VendorBranch::where('id', auth()->user()->branch_id)->first();
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => $branch_details->branch_slug, 'create' => 'branch_patient']);
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
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => $branch_details->branch_slug, 'create' => 'branch_patient_show', 'id' => $id]);
        // $get_patient = Patient::where('id', $id)->first();
        //     return view('user.patient.show', get_defined_vars());
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
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => $branch_details->branch_slug, 'create' => 'branch_patient_edit', 'id' => $id]);
        $get_patient = Patient::where('id', $id)->first();
        return view('user.patient.edit', get_defined_vars());
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
            'gender' => 'required',
            'martial_status' => 'required',
            'country' => 'required',
            'contact_number' => 'required|max:11',
            'age' => 'required',
            'zip_code' => 'required',
            'city' => 'required',
            'state' => 'required',
            'address' => 'required',
            'home_phone' => 'max:11',
        ]);
        // dd($request->all());
        $storing_patient_info = User::find($id);
        $storing_patient_info->vendor_id = auth()->id();
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
        session()->put('branch_patient_updated', true);
        return redirect()->route('branch_patient.index')
            ->with('success', 'Patient updated successfully');
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
    public function branch_patient_destroy_delete($id)
    {
        // dd($id);
        User::find($id)->delete();
        session()->put('branch_patient_delete', true);
        return redirect()->route('branch_patient.index')
            ->with('success', 'Patient deleted successfully');
    }
    public function branch_patient_filter(Request $request)
    {
        if ($request->patient_mr == "" && $request->patient_name == "") {
            session()->put('branch_patient_filter_one_field_required', true);
            return back();
        } else {
            $branch_details = VendorBranch::where('id', auth()->user()->branch_id)->first();
            return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => $branch_details->branch_slug, 'create' => 'branch_patient_filter', 'id' => $request->patient_mr, 'name' => $request->patient_name]);
        }

        // $get_auth_user = User::find(auth()->id());
        // if ($request->patient_name) {
        //     $get_patients = User::where("fullname", $request->patient_name)->where("branch_id", $get_auth_user->branch_id)->where("type", "6")->get();
        // }
        // if ($request->patient_mr) {
        //     $get_patients = User::where("fullname", $request->patient_mr)->where("branch_id", $get_auth_user->branch_id)->where("type", "6")->get();
        // }
    }
}
