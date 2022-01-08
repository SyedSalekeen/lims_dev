<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Vendor\PermissionId;
use App\Vendor\RolePermission;
use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\User;

class RolesPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return $get_vendor_branch_role = Role::all();
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "role_permission"]);

        // return in vendor profile controller

        // $getPermissions  = RolePermission::where('vendor_id', auth()->id())->get();
        // return view('vendor.role_permission.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "role_permission_create"]);

        // return in vendor profile controller

        // $permission = Permission::get();
        // $get_vendor_branch = VendorBranch::where('vendor_id', auth()->id())->where('delete_status', '0')->where('status', '1')->get();
        // return view('vendor.role_permission.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $get_user = User::find(auth()->id());
        // return $get_user;
// dd($request->all());
        $this->validate($request, [
            'branch' => 'required',
            'role' => 'required',
            'permission_check_box' => 'required',

        ]);

        $check_role_exist = RolePermission::where('role_id', $request->role)->where('vendor_id', auth()->id())->where('branch_id',$request->branch)->get();
        // dd(count($check_role_exist));
        if (count($check_role_exist)) {
            session()->put('role_already_exist',true);
            return redirect()->route('role_permission.index')
            ->with('success', 'Permission created successfully');
        } else {
            $role_permission_table = new RolePermission();
            $role_permission_table->vendor_id = auth()->id();
            $role_permission_table->branch_id = $request->branch;
            $role_permission_table->role_id = $request->role;
            $role_permission_table->save();

            foreach ($request->permission_check_box as $item) {
                $permissionIds = new PermissionId();
                $permissionIds->vendor_id = auth()->id();
                $permissionIds->permission_role_id = $role_permission_table->id;
                $permissionIds->permission_id = $item;
                $permissionIds->role_id = $request->role;
                $permissionIds->branch_id = $request->branch;

                $permissionIds->save();
            }
            session()->put('permission_created', true);
            return redirect()->route('role_permission.index')
                ->with('success', 'Permission created successfully');
        }

        // Role::create(['name' => 'writer', 'guard_name' => 'web', 'type' => '7']);
        // dd($request->all());
        // foreach($request->permission as $item){
        // }
        // $role = $request->role;
        // $role->syncPermissions($request->input('permission'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'id' => $id, 'requestpath' => "role_permission_show"]);
        // $permission = Permission::get();
        // $rolePermissions = DB::table("permission_ids")->where("permission_ids.permission_role_id", $id)
        //     ->pluck('permission_ids.permission_id', 'permission_ids.permission_id')
        //     ->all();
        // return view('vendor.role_permission.show', get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'id' => $id, 'requestpath' => "role_permission_edit"]);
        // $editId = $id;
        // $permission = Permission::get();
        // $rolePermissions = DB::table("permission_ids")->where("permission_ids.permission_role_id", $id)
        //     ->pluck('permission_ids.permission_id', 'permission_ids.permission_id')
        //     ->all();
        // // $permission = Permission::get();
        // // $getting_permissions = PermissionId::where('permission_role_id', $id)->get();
        // // dd($getting_permissions);

        // return view('vendor.role_permission.edit', get_defined_vars());
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
        $get_role_permission_details = RolePermission::find($id);
        $delete_previous_permission = PermissionId::where('permission_role_id', $id)->delete();
        foreach ($request->permission as $item) {
            $permissionIds = new PermissionId();
            $permissionIds->vendor_id = auth()->id();
            $permissionIds->permission_role_id = $id;
            $permissionIds->permission_id = $item;
            $permissionIds->role_id = $request->role;
            $permissionIds->branch_id = $request->branch;
            $permissionIds->save();
        }
        session()->put('permission_updated',true);
        return redirect()->route('role_permission.index')
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
    public function role_permission_delete($id){
        RolePermission::find($id)->delete();
        $role = PermissionId::where('permission_role_id', $id)->delete();
        session()->put('permission_deleted',true);
        return redirect()->route('role_permission.index')
            ->with('success', 'Permission deleted successfully');
    }
}
