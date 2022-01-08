<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TestGig;
use App\User;
use App\Vendor\PermissionId;
use App\Vendor\RolePermission;
use App\VendorBranch;

class TestGigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branch_details=VendorBranch::where('id',auth()->user()->branch_id)->first();
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug,'requestpath' =>$branch_details->branch_slug,'create' =>'branch_gigs']);
        // $get_test_gigs = TestGig::where('branch_vendor_id', auth()->id())->get();
        // $get_user = User::where('id', auth()->id())->first();
        // $get_permission = RolePermission::where('role_id', $get_user->role_id)
        //     ->where('branch_id', $get_user->branch_id)
        //     ->first();
        // $get_permission_edit_gig = PermissionId::where('permission_role_id', @$get_permission->id)
        //     ->where('branch_id', @$get_permission->branch_id)
        //     ->where('role_id', @$get_permission->role_id)
        //     ->where('permission_id', '19')
        //     ->first();
        // $get_permission_delete_gig = PermissionId::where('permission_role_id', @$get_permission->id)
        //     ->where('branch_id', @$get_permission->branch_id)
        //     ->where('role_id', @$get_permission->role_id)
        //     ->where('permission_id', '20')
        //     ->first();
        // return view('user.test_gig.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branch_details=VendorBranch::where('id',auth()->user()->branch_id)->first();
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug,'requestpath' =>$branch_details->branch_slug,'create' =>'branch_gigs_create']);
        // return view('user.test_gig.create');
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
            'test_name' => 'required',
            'test_amount' => 'required',
            'test_best_range' => 'required',
            'test_unit' => 'required',
            'lab_test' => 'required',

        ]);
        $check_gig_exist = TestGig::where('vendor_id',auth()->id())->where('test_name', $request->test_name)->first();
        // dd($check_gig_exist);
        if ($check_gig_exist) {
            session()->put('branch_gig_already_exist', true);
            return redirect()->route('branch-test-gig.index')
                ->with('success', 'Test Gig already exist');
        } else{
            $testGig = new TestGig();
            $testGig->vendor_id = $get_auth_user->vendor_id;
            $testGig->branch_vendor_id = auth()->id();
            $testGig->branch_id = $get_auth_user->branch_id;
            $testGig->lab_test = $request->lab_test;
            $testGig->test_name = $request->test_name;
            $testGig->test_best_range = $request->test_best_range;
            $testGig->test_unit = $request->test_unit;
            $testGig->test_amount = $request->test_amount;
            $testGig->save();
            session()->put('branch_gig_created', true);
            return redirect()->route('branch-test-gig.index')
                ->with('success', 'Gig created successfully');
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
        // dd($id);
        $branch_details=VendorBranch::where('id',auth()->user()->branch_id)->first();
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug,'requestpath' =>$branch_details->branch_slug,'create' =>'branch_gigs_edit','id'=>$id]);
        // $get_edit_gig = TestGig::find($id);
        // return view('user.test_gig.edit', get_defined_vars());
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
            'test_name' => 'required',
            'test_amount' => 'required',
            'test_best_range' => 'required',
            'test_unit' => 'required',
            'lab_test' => 'required',

        ]);
        $update_test_gig = TestGig::find($id);
        $update_test_gig->test_name = $request->test_name;
        $update_test_gig->lab_test = $request->lab_test;
        $update_test_gig->test_amount = $request->test_amount;
        $update_test_gig->test_best_range = $request->test_best_range;
        $update_test_gig->test_unit = $request->test_unit;
        $update_test_gig->save();
        session()->put('branch_gig_updated', true);
        return redirect()->route('branch-test-gig.index')
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
    public function destroy_delete($id){
        TestGig::find($id)->delete();
        session()->put('branch_gig_deleted', true);
        return redirect()->route('branch-test-gig.index')
            ->with('success', 'Test Gig deleted successfully');
    }
}
