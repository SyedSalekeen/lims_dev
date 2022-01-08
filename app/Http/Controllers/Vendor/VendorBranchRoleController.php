<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\VendorBranch;
use App\VendorBranchRole;
use Illuminate\Http\Request;

class VendorBranchRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $shop = VendorBranchRole::where('delete_status','0')->where('vendor_id',auth()->id())->orderBy('id','DESC')->paginate(5);
        return view ('vendor.role.index',compact('shop'))
        ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getBranch = VendorBranch::where('vendor_id',auth()->id())->where('status','1')->where('delete_status','0')->get();
        // return $getBranch;
        return view('vendor.role.create',get_defined_vars());
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
        $vendor_branch_role = new VendorBranchRole();
        $vendor_branch_role->vendor_id = auth()->id();
        $vendor_branch_role->branch_id = $request->branch_id;
        $vendor_branch_role->role_name = $request->role_name;
        $vendor_branch_role->save();
        return redirect()->route('branch_role.index')
        ->with('success','Role created successfully');
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
        $getBranch = VendorBranch::where('vendor_id',auth()->id())->where('status','1')->where('delete_status','0')->get();
        $role = VendorBranchRole::find($id);
        // return $role;
        return view('vendor.role.edit',get_defined_vars());
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
        $branch_role_edit = VendorBranchRole::find($id);
        $branch_role_edit->role_name = $request->role_name;
        $branch_role_edit->save();
        return redirect()->route('branch_role.index')
        ->with('success','Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $branch_role_delete = VendorBranchRole::find($id);
        $branch_role_delete->delete_status = "1";
        $branch_role_delete->save();
        return redirect()->route('branch_role.index')
        ->with('success','Role deleted successfully');
    }
}
