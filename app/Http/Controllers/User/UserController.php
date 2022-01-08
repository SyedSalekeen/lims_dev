<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use App\Vendor\PermissionId;
use App\Vendor\RolePermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\VendorBranch;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branch_details = VendorBranch::where('id', auth()->user()->branch_id)->first();
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => $branch_details->branch_slug, 'create' => 'branch_user']);
        // $get_user = User::where('id', auth()->id())->first();

        // $get_permission = RolePermission::where('role_id', $get_user->role_id)
        //     ->where('branch_id', $get_user->branch_id)
        //     ->first();
        // // return $get_permission;
        // $get_permission_edit_user = PermissionId::where('permission_role_id', @$get_permission->id)
        //     ->where('branch_id', @$get_permission->branch_id)
        //     ->where('role_id', @$get_permission->role_id)
        //     ->where('permission_id', '15')
        //     ->first();
        // $get_permission_delete_user = PermissionId::where('permission_role_id', @$get_permission->id)
        //     ->where('branch_id', @$get_permission->branch_id)
        //     ->where('role_id', @$get_permission->role_id)
        //     ->where('permission_id', '16')
        //     ->first();
        // $user = User::where('vendor_id', auth()->id())->where('delete_status', '0')->get();
        // return view('user.users.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branch_details = VendorBranch::where('id', auth()->user()->branch_id)->first();
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => $branch_details->branch_slug, 'create' => 'branch_user_create']);
        // $get_vendor_branch_role = Role::where('type', '!=', '3')->get();
        // return view('user.users.create', get_defined_vars());
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
        // dd($get_auth_user);

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
            'role' => 'required',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:7168|sometimes',
        ]);
        $get_role_type = Role::where('id', $request->role)->first();
        // return $get_role_type;
        $add_vendor = new User();
        if ($request->hasfile('profile_image')) {
            $file = $request->file('profile_image');
            $extension = $file->getClientOriginalExtension();
            $filename = uniqid() . "." . $extension;
            $file->move(public_path('uploads/profile/'), $filename);
            $add_vendor->profile_image = $filename;
        }
        $add_vendor->vendor_id = $get_auth_user->vendor_id;
        $add_vendor->vendor_branch_id = auth()->id();
        $add_vendor->first_name = $request->first_name;
        $add_vendor->last_name = $request->last_name;
        $add_vendor->email = $request->email;
        $add_vendor->password = Hash::make($request->password);
        $add_vendor->contact_number = $request->contact_number;
        $add_vendor->city = $request->city;
        $add_vendor->state = $request->state;
        $add_vendor->country = $request->country;
        $add_vendor->address = $request->address;
        $add_vendor->branch_id = $get_auth_user->branch_id;
        $add_vendor->role_id = $request->role;
        $add_vendor->laboratory_slug = $get_auth_user->laboratory_slug;
        $add_vendor->type = $get_role_type->type;

        $add_vendor->status = "1";
        $add_vendor->save();
        session()->put('branch_user_create', true);
        return redirect()->route('branch_user.index')
            ->with('success', 'User created successfully');
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
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => $branch_details->branch_slug, 'create' => 'branch_user_show', 'id' => $id]);
        // $get_vendor_branch_role = Role::all();
        // $user_show = User::find($id);
        // return view('user.users.show', get_defined_vars());
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
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => $branch_details->branch_slug, 'create' => 'branch_user_edit', 'id' => $id]);
        // $get_vendor_branch_role = Role::all();
        // $user_edit = User::find($id);
        // return view('user.users.edit', get_defined_vars());
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
            'contact_number' => 'required|max:11',
            'country' => 'required',
            'city' => 'required',
            'state' => 'required',
            'address' => 'required',
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
        $add_vendor->role_id = $request->role;
        $add_vendor->type = $get_role_type->type;
        $add_vendor->save();
        session()->put('branch_user_update', true);
        return redirect()->route('branch_user.index')
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
    public function branch_user_destroy_delete($id)
    {
        $delete_user = User::find($id)->delete();
        session()->put('branch_user_delete', true);
        return redirect()->route('branch_user.index')
            ->with('success', 'User deleted successfully');
    }
}
