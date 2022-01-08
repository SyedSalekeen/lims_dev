<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\VendorBranch;
use Illuminate\Support\Facades\Hash;
class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return "a";

        $branch_details=VendorBranch::where('id',auth()->user()->branch_id)->first();

return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug,'requestpath' =>$branch_details->branch_slug,'create' =>'profile_create']);



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
            'first_name' => 'required',
            'last_name' => 'required',
            'contact_number' => 'required',
            'country' => 'required',
            'city' => 'required',
            'state' => 'required',
            'address' => 'required',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:7168|sometimes',
        ]);
        $update_vendor = User::find($id);
        // dd($update_vendor);
        $update_vendor->first_name = $request->first_name;
        $update_vendor->last_name = $request->last_name;

        if ($request->password) {
            $update_vendor->password = Hash::make($request->password);
        }
        if ($request->hasfile('profile_image')) {
            $file = $request->file('profile_image');
            $extension = $file->getClientOriginalExtension();
            $filename = uniqid() . "." . $extension;
            $file->move(public_path('uploads/profile/'), $filename);
            $update_vendor->profile_image = $filename;
        }

        $update_vendor->contact_number = $request->contact_number;
        $update_vendor->city = $request->city;
        $update_vendor->state = $request->state;
        $update_vendor->country = $request->country;
        $update_vendor->address = $request->address;
        $update_vendor->save();

        session()->put('branch_user_profile_updated',true);
        $branch_details=VendorBranch::where('id',auth()->user()->branch_id)->first();
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug,'requestpath' =>$branch_details->branch_slug,'create' =>'profile_create']);
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




}
