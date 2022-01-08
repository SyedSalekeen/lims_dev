<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Patient;
use App\Vendor\RolePermission;
use Illuminate\Http\Request;
use App\VendorBranch;
use App\User;
use App\Vendor\PermissionId;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserLoginController extends Controller
{
    public function signin(Request $request, $slug, $requestpath)
    {

        $check_branch_url = VendorBranch::where('branch_url', $request->url())->first();
        // session()->put("url_for_login_logo",url()->current());
        if ($check_branch_url) {
            $get_branch_logo = User::where('id', $check_branch_url->vendor_id)->first();
        }
        if ($check_branch_url) {
            return view('user.login', get_defined_vars());
        } else {
            return "invalid Url";
        }
    }

    public function login_submit(Request $request)
    {

        $check_patient = User::where('id', $request->email)->where("type", "6")->first();

        // dd($check_patient);

        if ($check_patient) {
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                // dd(Auth()->user()->laboratory_slug);
                return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => session()->get('branch_name')]);
            } else {
                session()->put('branch_user_credentials_not_matched', true);
                return back();
            }
            // $mrNumber = $request->email;
            // $mrpassword = $request->password;
            // if (!Hash::check($mrpassword, $check_patient->password)) {
            //     return "login Failed";
            // }
            // $get_vendor_laboratory_slug = User::where('vendor_id',$check_patient->vendor_id)->first();
            // $vendor_branch_find = VendorBranch::where('branch_url', session()->get('url_current_for_user_logout'))->first();
            // session()->put('patient_id_after_login', true);
            // return redirect()->route('requestpath', ['slug' => $get_vendor_laboratory_slug->laboratory_slug, 'requestpath' => $vendor_branch_find->branch_slug]);
        } else {

            // dd(session()->get('branch_name'));
            // return ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => session()->get('branch_name')];
            $check_email = User::where('email', $request->email)->first();
            // return $check_email;


            // return $get_bracnh_status;
            if ($check_email) {
                $get_bracnh_status = VendorBranch::find($check_email->branch_id);
                $get_vendor = User::find($check_email->vendor_id);
            }

            if ($check_email) {
                if ($check_email->type == "3" || $check_email->type == "4" || $check_email->type == "5") {
                    // dd("type matched");
                    if ($get_vendor->status == "1") {
                        if ($get_bracnh_status->status == "1") {
                            if ($check_email->status == "1") {


                                $credentials = $request->only('email', 'password');
                                if (Auth::attempt($credentials)) {
                                    // dd(Auth()->user()->laboratory_slug);
                                    return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => session()->get('branch_name')]);
                                } else {
                                    return back()->with('success', 'Your credentials does not matched');
                                }
                            } else {
                                return back()->with('success', 'Your Branch is blocked by admin');
                            }
                        } else{
                            return back()->with('success', 'Your Branch is blocked by admin');
                        }
                    } else {
                        return back()->with('success', 'Your Branch is blocked by admin');
                    }
                } else {
                    return back()->with('success', 'Your credentials does not matched');
                }
            } else {
                // dd("here");
                // session()->put('branch_user_credentials_not_matched', true);
                return back()->with('success', 'Your credentials does not matched');
            }
        }
    }
}
