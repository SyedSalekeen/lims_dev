<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\Http\Controllers\Controller;
use App\User;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Country;
use App\State;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id', 'DESC')->where('delete_status', '0')->where('vendor_id', '1')->where('id', '!=', '1')->get();
        return view('admin.user.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $get_country = Country::all();
        $roles = Role::pluck('name', 'name')->all();
        return view('admin.user.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'contact_number' => 'required',
            'country' => 'required',
            'city' => 'required',
            'state' => 'required',
            'address' => 'required',
            'branch_limit' => 'required',
            'labortary_name' => 'required',
            'laboratory_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:7168|sometimes',
        ]);

        $checkLaboratoryName = User::where('laboratory_name', $request->labortary)->first();
        if ($checkLaboratoryName) {
            return redirect()->route('users.index')
                ->with('error', 'Laboratory Name already exist');
        } else {
            $verificationCode = random_int(100000, 999999);
            $add_vendor = new User();
            $add_vendor->vendor_id = auth()->id();
            $add_vendor->first_name = $request->first_name;
            $add_vendor->last_name = $request->last_name;
            $add_vendor->email = $request->email;
            $add_vendor->password = Hash::make($request->password);
            $add_vendor->contact_number = $request->contact_number;
            $add_vendor->city = $request->city;
            $add_vendor->state = $request->state;
            $add_vendor->country = $request->country;
            $add_vendor->address = $request->address;
            $add_vendor->branch_limit = $request->branch_limit;
            $add_vendor->laboratory_name = $request->labortary;
            $add_vendor->laboratory_slug = $request->labortary_name;
            $add_vendor->laboratory_url = $request->laboratory_url . '/' . $request->labortary_name;
            if ($request->hasfile('laboratory_logo')) {
                $file = $request->file('laboratory_logo');
                $extension = $file->getClientOriginalExtension();
                $filename = uniqid() . "." . $extension;
                $file->move(public_path('uploads/logo/'), $filename);
                $add_vendor->laboratory_logo = $filename;
            }
            $add_vendor->type = "2";
            $add_vendor->status = "1";
            $add_vendor->verifcation_code = $verificationCode;
            $add_vendor->save();
        }


        session()->put("vendor_verification_code", $verificationCode);
        session()->put("vendor_email", $request->email);
        session()->put("vendor_password", $request->password);
        $token = sha1(uniqid(time(), true));
        $emailToSend = $request->email;
        Mail::send('vendor.mail.verificaction_code', ['data' => route('vendor_profile.edit', ['token' => $token])], function ($messages) use ($emailToSend) {
            $messages->to($emailToSend);
            $messages->subject('LIMS VERIFICATION CODE');
        });


        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *0000
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        // return $user;
        $get_country = Country::find($user->country);
        // return $get_country;
        $get_state = State::find($user->state);
        // return $get_state;
        $get_city = City::find($user->city);
        // return $get_city;
        return view('admin.user.show', get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { //   dd($id);
        $user = User::find($id);
        $get_country = Country::all();
        $get_state = State::where('country_id', $user->country)->get();
        $get_city = City::where('state_id', $user->state)->get();
        // return $get_state;
        // dd($user);
        return view('admin.user.edit', get_defined_vars());
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
        // dd($request->update_laboratory_logo);
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',

            'contact_number' => 'required',
            'country' => 'required',
            'city' => 'required',
            'state' => 'required',
            'address' => 'required',
            'branch_limit' => 'required',
            'labortary_name' => 'required',
        ]);
        $add_vendor = User::find($id);
        $add_vendor->first_name = $request->first_name;
        $add_vendor->last_name = $request->last_name;
        if ($request->password) {
            $add_vendor->password = Hash::make($request->password);
        }
        $add_vendor->contact_number = $request->contact_number;
        $add_vendor->city = $request->city;
        $add_vendor->state = $request->state;
        $add_vendor->country = $request->country;
        $add_vendor->address = $request->address;
        $add_vendor->branch_limit = $request->branch_limit;
        $add_vendor->laboratory_name = $request->labortary;
        $add_vendor->laboratory_slug = $request->labortary_name;
        $add_vendor->laboratory_url = $request->laboratory_url . '/' . $request->labortary_name;
        if ($request->hasFile('update_laboratory_logo')) {
            $file = $request->file('update_laboratory_logo');
            $extension = $file->getClientOriginalExtension();
            $filename = uniqid() . "." . $extension;
            $file->move(public_path('uploads/logo/'), $filename);
            $add_vendor->laboratory_logo = $filename;
        }
        $add_vendor->save();

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
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
    public function user_delete($id)
    {
        $changeDeleteStatus = User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
    public function get_states(Request $request)
    {
        $states = State::where('country_id', $request->id)->get();
        return ["data" => $states];
    }

    public function get_country(Request $request)
    {
        $country = City::where('state_id', $request->id)->get();
        return ["data" => $country];
    }
}
