<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\VendorBranch;
use App\VendorBranchRole;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Auth;
use Illuminate\Support\Facades\Mail;

class VendorUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(auth()->id());
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "vendor_user"]);

        // return in vendor profile controller

        // $user = User::where('vendor_id',auth()->id())->where('delete_status','0')->get();
        // return view('vendor.user.index',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "vendor_user_create"]);

        // return in vendor profile controller

        // $get_vendor_branch = VendorBranch::where('vendor_id', auth()->id())->where('delete_status', '0')->where('status', '1')->get();
        // $get_vendor_branch_role = Role::all();
        // return view('vendor.user.create', get_defined_vars());
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

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'contact_number' => 'required|max:11',
            'country' => 'required',
            'city' => 'required',
            'state' => 'required',
            'address' => 'required',
            'branch' => 'required',
            'role' => 'required',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:7168|sometimes',
        ]);
        $check_user_exit = User::where('branch_id', $request->branch)->where('role_id', $request->role)->first();
        // return $check_user_exit;
        if ($check_user_exit) {
            session()->put('vendor_user_already_exist', true);
            return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "vendor_user_index"]);
        } else {
            $get_role_type = Role::where('id', $request->role)->first();
            $get_branch_slug = VendorBranch::find($request->branch);
            $verificationCode = random_int(100000, 999999);
            $add_vendor = new User();
            if ($request->hasfile('profile_image')) {
                $file = $request->file('profile_image');
                $extension = $file->getClientOriginalExtension();
                $filename = uniqid() . "." . $extension;
                $file->move(public_path('uploads/profile/'), $filename);
                $add_vendor->profile_image = $filename;
            }
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
            $add_vendor->laboratory_slug = Auth::user()->laboratory_slug;
            $add_vendor->branch_id = $request->branch;
            $add_vendor->role_id = $request->role;
            $add_vendor->type = $get_role_type->type;
            $add_vendor->status = "1";
            $add_vendor->verifcation_code = $verificationCode;
            $add_vendor->save();
            session()->put("vendor_verification_code", $verificationCode);
            session()->put("vendor_email", $request->email);
            session()->put("vendor_password", $request->password);
            // $token = sha1(uniqid(time(), true));
            // $emailToSend = $request->email;
            // Mail::send('vendor.mail.verificaction_code', ['data' => route('vendor_profile.edit', ['token' => $token])], function ($messages) use ($emailToSend) {
            //     $messages->to($emailToSend);
            //     $messages->subject('LIMS VERIFICATION CODE');
            // });
            session()->put('vendor_user_created', true);
            return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "vendor_user_index"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'user_id' => $id, 'requestpath' => "vendor_user_show"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'user_id' => $id, 'requestpath' => "vendor_user_edit"]);
        // $get_vendor_branch = VendorBranch::where('vendor_id', auth()->id())->where('delete_status', '0')->where('status', '1')->get();
        // $get_vendor_branch_role = Role::all();
        // $user_edit = User::find($id);
        // return view('vendor.user.edit', get_defined_vars());
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
        // return $id;
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'contact_number' => 'required|max:11',
            'country' => 'required',
            'city' => 'required',
            'state' => 'required',
            'address' => 'required',
            'branch' => 'required',
            'role' => 'required',
        ]);
        $get_role_type = Role::where('id', $request->role)->first();
        // return $get_role_type;
        $add_vendor = User::find($id);
        $add_vendor->vendor_id = auth()->id();
        $add_vendor->first_name = $request->first_name;
        $add_vendor->last_name = $request->last_name;

        if ($request->password) {
            $add_vendor->password = Hash::make($request->password);
        }

        if ($request->hasfile('profile_image')) {
            $file = $request->file('profile_image');
            $extension = $file->getClientOriginalExtension();
            $filename = uniqid() . "." . $extension;
            $file->move(public_path('uploads/profile/'), $filename);
            $add_vendor->profile_image = $filename;
        }


        $add_vendor->contact_number = $request->contact_number;
        $add_vendor->city = $request->city;
        $add_vendor->state = $request->state;
        $add_vendor->country = $request->country;
        $add_vendor->address = $request->address;
        $add_vendor->branch_id = $request->branch;
        $add_vendor->role_id = $request->role;
        $add_vendor->type = $get_role_type->type;
        $add_vendor->status = "1";
        $add_vendor->save();
        session()->put('vendor_user_updated', true);
        return redirect()->route('vendor_user.index')
            ->with('success', 'User edit successfully');
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
    public function vendor_user_destroy_delete($id){

        User::find($id)->delete();
        session()->put('vendor_user_deleted', true);
        return redirect()->route('vendor_user.index')
            ->with('success', 'User deleted successfully');
    }

    public function get_vendor_branch_role(Request $request)
    {

        $vendor_branch_role = VendorBranchRole::where('branch_id', $request->id)->where('status', '1')->where('delete_status', '0')->get();
        return ["data" => $vendor_branch_role];
    }
}
