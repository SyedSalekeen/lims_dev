<?php

namespace App\Http\Controllers;

use App\ChangeTheme;
use App\ThemeChange;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use function GuzzleHttp\Promise\all;

class LoginController extends Controller
{

    public function dashboard_view()
    {
        return view('admin.layouts.master');
    }
    // public function user_login_view($slug)
    // {
    //     // return $slug;
    //     // $_ENV['APP_URL'] = $slug;

    //     session()->put('slug', $slug);
    //     $check_slug_exist = User::where('laboratory_slug', $slug)->first();
    //     // return $check_slug_exist;
    //     if ($check_slug_exist) {
    //         return view('users_login.login', get_defined_vars());
    //     }
    // }
    public function user_login_view(Request $request, $slug)
    {

        if (session()->get('userlogin')) {
            $data = User::orderBy('id', 'DESC')->where('delete_status', '0')->paginate(5);
            return view('admin.dashboard.index');
            return view('admin.user.index', compact('data'))
                ->with('i', ($request->input('page', 1) - 1) * 5);
        }
        session()->put('slug', $slug);
        $check_slug_exist = User::where('laboratory_slug', $slug)->first();
        // return $check_slug_exist;
        if ($check_slug_exist) {
            $get_color = ChangeTheme::where('vendor_id',$check_slug_exist->id)->first();
            // return $get_color;
            return view('users_login.login', get_defined_vars());
        } else {
            return back();
        }
    }
    public function user_login_submit(Request $request)
    {

        $check_status = User::where('email', $request->email)->first();
        if ($check_status) {
            if ($check_status->type == 2) {
                if ($check_status->status == "1") {
                    $credentials = $request->only('email', 'password');
                    if (Auth::attempt($credentials)) {
                        $get_auth_user = User::find(auth()->id());
                        if ($get_auth_user->email_status == '0') {

                            return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "vendor_verification_code_view","email"=>$request->email]);
                        } else {
                            session()->put('userlogin', true);
                            return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "vendor_dashboard"]);
                        }
                    } else {

                        session()->forget('userlogin');
                        return back()
                            ->with('success', 'Your credentials does not matched');
                    }
                } else {
                    return back()
                        ->with('success', 'Your laboratory is blocked by admin');
                }
            } else {
                return back()
                    ->with('success', 'Your credentials does not matched');
            }
        } else {
            return back()
                ->with('success', 'Your credentials does not matched');
        }
    }


    // vendor verification code
    public function vendor_verification_code(Request $request)
    {
        // dd($request->all());
        $code = $request->num1 . $request->num2 . $request->num3 . $request->num4 . $request->num5 . $request->num6;
        // dd($code);
        $get_auth_user = User::find(auth()->id());
        // dd($get_auth_user);
        if ($code == $get_auth_user->verifcation_code) {
            session()->put('userlogin', true);
            $get_auth_user->email_status = "1";
            $get_auth_user->save();
            return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "vendor_dashboard"]);
        } else {
            session()->put('vendor_invalid_verification_code', true);
            return back();
        }
    }


    public function user_logout()
    {
        $sessionCode = session()->get('slug');

        Session::flush();
        Auth::logout();

        return redirect($sessionCode);
    }

    // public function vendor_login(Request $request)
    // {
    //     // dd($request->all());
    //     // $currentURL = URL::current();
    //     // dd($currentURL);
    //     $finding_user_type = User::where('email', $request->email)->first();
    //     $credentials = [
    //         'email' => $request['email'],
    //         'password' => $request['password'],
    //     ];
    //     if ($finding_user_type->type == "2") {
    //         if (Auth::attempt($credentials)) {
    //             return redirect()->route('dashboard_view');
    //         }
    //     }
    // }

    public function test()
    {

        return "ac";
    }
}
