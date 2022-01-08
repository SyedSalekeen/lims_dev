<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\VendorBranch;
use Illuminate\Support\Facades\Auth;
use App\User;

use Illuminate\Support\Facades\Session;

class UserDashboard extends Controller
{
    public function user_dashboard(){
        // dd(Auth::id());
        $branch_details=VendorBranch::where('id',auth()->user()->branch_id)->first();
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug,'requestpath' =>$branch_details->branch_slug,'create' =>'user_dashboard']);
        // return view('user.dashboard.index');
    }
    public function branch_user_logout(Request $request){
        $lb = Auth()->user()->laboratory_slug;
        // $sessionCode = session()->get('branch_name');
        $get_url = User::find(auth()->id());
        $sessionCode = session()->get('branch_name');
        $temp_store = session()->get("url_current_for_user_logout");
        // Session::flush();
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();


        session()->put("url_current_for_user_logout",$temp_store);
        session()->put('branch_user_logout',true);

// redirect($sessionCode);

        return redirect()->route('requestpath', ['slug' => $lb,'requestpath' => $sessionCode]);
    }
}
