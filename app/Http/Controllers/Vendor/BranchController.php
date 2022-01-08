<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\VendorBranch;
use App\User;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "vendor_branch"]);

        //  return in vendor profile controller

        // $shop = VendorBranch::where('delete_status','0')->orderBy('id','DESC')->paginate(5);
        // return view ('vendor.branch.index',compact('shop'))
        // ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function storeBranch(Request $request)
    {

        // dd($request->all());
        $get_added_branch = VendorBranch::where('vendor_id', auth()->id())->get();
        $get_branch_limit = User::where('id', auth()->id())->first();
        //    return $get_added_branch;
        // dd($get_branch_limit);
        if (count($get_added_branch) >= $get_branch_limit->branch_limit) {
            // dd("here");
            session()->put('branch_create_limit_cross', true);
            return redirect()->route('branch.index')
                ->with('error', 'You cannot add more branches');
        } else {

            $request->validate([
                'branch' => 'required',
            ]);


            $branch = new VendorBranch();
            $branch->vendor_id = auth()->id();
            $branch->branch_name = $request->branch;
            $branch->branch_slug = $request->branch_name;
            $branch->branch_url = Auth()->user()->laboratory_url . '/' . $request->branch_name;
            $branch->status = "1";
            $branch->save();

            session()->put('branch_create_session', true);
            return redirect()->route('branch.index')
                ->with('success', 'Branch created successfully');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //   return  $request->path();
        // return redirect(Auth()->user()->laboratory_url);
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "vendor_branch_create"]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     // dd("here");
    //     dd($request->all);
    // }

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
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'branch_id' => $id, 'requestpath' => "vendor_branch_edit"]);
        // $branch = VendorBranch::find($id);
        // return view('vendor.branch.edit', compact('branch'));
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

        $request->validate([
            'branch' => 'required',
        ]);
        $branch = VendorBranch::find($id);
        $branch->branch_name = $request->branch;
        $branch->branch_url = Auth()->user()->laboratory_url . '/' . $request->branch_name;
        $branch->status = "1";
        $branch->save();
        session()->put('branch_updated', true);
        return redirect()->route('branch.index')
            ->with('success', 'Branch updated successfully');
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

    }
    public function branch_destroy_delete($id)
    {
        $delete_branch = VendorBranch::find($id);
        $delete_branch->delete();
        session()->put("vendor_branch_deleted",true);
        return redirect()->route('branch.index')
            ->with('success', 'Branch deleted successfully');
    }
    public function branch_change_status(Request $request)
    {
        // return ["data" => $request->all()];
        $branch_status = VendorBranch::find($request->branch_id);
        $branch_status->status = $request->status;
        $branch_status->save();
    }
}
