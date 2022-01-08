<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class DashboardController extends Controller
{
    public function vendor_dashboard(){

         return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "vendor_dashboard"]);
        // return view('admin.dashboard.index');
    }
     public function employees(request $request)
    {
        // dd('here');
        $get_auth_user = User::find(auth()->id());
         $employeeData = User::where('type','!=','2')->where('vendor_id',$get_auth_user->id)->has('get_branch_name')->get();
        return view('admin.vendor_dashboard.employees', get_defined_vars());

    }
}
