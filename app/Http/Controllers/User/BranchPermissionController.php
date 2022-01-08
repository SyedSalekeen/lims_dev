<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Vendor\RolePermission;
use App\Vendor\PermissionId;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\VendorBranch;
use DB;

class BranchPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branch_details=VendorBranch::where('id',auth()->user()->branch_id)->first();
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug,'requestpath' =>$branch_details->branch_slug,'create' =>'branch_permission']);
        // $id = auth()->id();
        // $get_auth_user = User::find($id);
        // $getPermissions  = RolePermission::where('branch_id', $get_auth_user->branch_id)->where('role_id','!=','1')->get();
        // $get_vendor_branch_role = Role::where('id','!=','1');
        // return view('user.role_permission.index', get_defined_vars());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branch_details=VendorBranch::where('id',auth()->user()->branch_id)->first();
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug,'requestpath' =>$branch_details->branch_slug,'create' =>'branch_permission_create']);
        // $id = auth()->id();
        // $get_auth_user = User::find($id);
        // $get_permission_id = RolePermission::where('branch_id',$get_auth_user->branch_id)->first();
        // $get_all_permission = PermissionId::where('permission_role_id',$get_permission_id->id)->get();
        // $get_vendor_branch_role = Role::where('id','!=','1')->get();
        // return view('user.role_permission.create', get_defined_vars());
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
        $id = auth()->id();
        $get_auth_user = User::find($id);
        $this->validate($request, [
            'role' => 'required',
            'permission_check_box' => 'required',

        ]);

        $check_role_exist = RolePermission::where('role_id', $request->role)->where('branch_id',$get_auth_user->branch_id)->get();
        // dd(count($check_role_exist));
        if (count($check_role_exist)) {
            session()->put('role_already_exist',true);
            return redirect()->route('branch_perission.index')
            ->with('success', 'Role Already exist');
        } else {
            $role_permission_table = new RolePermission();
            $role_permission_table->vendor_id = $get_auth_user->vendor_id;
            $role_permission_table->branch_vendor_id = auth()->id();
            $role_permission_table->branch_id = $get_auth_user->branch_id;
            $role_permission_table->role_id = $request->role;
            $role_permission_table->save();

            foreach ($request->permission_check_box as $item) {
                $permissionIds = new PermissionId();
                $permissionIds->vendor_id = auth()->id();
                $permissionIds->permission_role_id = $role_permission_table->id;
                $permissionIds->permission_id = $item;
                $permissionIds->role_id = $request->role;
                $permissionIds->branch_id = $get_auth_user->branch_id;
                $permissionIds->save();
            }
            // session()->put('permission_created', true);
            return redirect()->route('branch_perission.index')
                ->with('success', 'Permission created successfully');
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
        $branch_details=VendorBranch::where('id',auth()->user()->branch_id)->first();
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug,'requestpath' =>$branch_details->branch_slug,'create' =>'branch_permission_show','id'=>$id]);
        // $auth_id = auth()->id();
        // $get_auth_user = User::find($auth_id);
        // $get_permission_id = RolePermission::where('branch_id',$get_auth_user->branch_id)->first();
        // $get_all_permission = PermissionId::where('permission_role_id',$get_permission_id->id)->get();
        // $get_vendor_branch_role = Role::all();
        // $get_permission = RolePermission::where('id',$id)->first();
        // $permission = Permission::get();
        // $rolePermissions = DB::table("permission_ids")->where("permission_ids.permission_role_id", $id)
        //     ->pluck('permission_ids.permission_id', 'permission_ids.permission_id')
        //     ->all();

        // return view('user.role_permission.show', get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branch_details=VendorBranch::where('id',auth()->user()->branch_id)->first();
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug,'requestpath' =>$branch_details->branch_slug,'create' =>'branch_permission_edit','id'=>$id]);
        // $auth_id = auth()->id();
        // $get_auth_user = User::find($auth_id);
        // $get_permission_id = RolePermission::where('branch_id',$get_auth_user->branch_id)->first();
        // $get_all_permission = PermissionId::where('permission_role_id',$get_permission_id->id)->get();
        // $get_vendor_branch_role = Role::all();
        // $get_permission = RolePermission::where('id',$id)->first();
        // $permission = Permission::get();
        // $rolePermissions = DB::table("permission_ids")->where("permission_ids.permission_role_id", $id)
        //     ->pluck('permission_ids.permission_id', 'permission_ids.permission_id')
        //     ->all();

        // return view('user.role_permission.edit', get_defined_vars());
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

        // dd($request->permission);
        // dd($request->all());
        $get_auth_user = User::find(auth()->id());
        $get_role_permission_details = RolePermission::find($id);
        $delete_previous_permission = PermissionId::where('permission_role_id', $id)->delete();
        foreach ($request->permission as $item) {
            $permissionIds = new PermissionId();
            $permissionIds->vendor_id = auth()->id();
            $permissionIds->permission_role_id = $id;
            $permissionIds->permission_id = $item;
            $permissionIds->role_id = $request->role;
            $permissionIds->branch_id = $get_auth_user->branch_id;
            $permissionIds->save();
        }
        // PermissionId::where('id')
        // session()->put('permission_updated',true);
        return redirect()->route('branch_perission.index')
            ->with('success', 'Permission updated successfully');
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
    public function branch_perission_delete($id){
        RolePermission::find($id)->delete();
        PermissionId::where('permission_role_id',$id)->delete();
        return redirect()->route('branch_perission.index')
            ->with('success', 'Permission deleted successfully');
    }
}
