<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProfitReport;
use App\User;
use App\Vendor\PermissionId;
use App\Vendor\RolePermission;
use App\VendorBranch;
use App\Exports\BranchProfitExport;
use Maatwebsite\Excel\Facades\Excel;


class BranchProfitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branch_details=VendorBranch::where('id',auth()->user()->branch_id)->first();
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug,'requestpath' =>$branch_details->branch_slug,'create' =>'branch_profit']);
    }

    public function export()
    {
        return Excel::download(new BranchProfitExport, 'Profit_report.xlsx');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branch_details=VendorBranch::where('id',auth()->user()->branch_id)->first();
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug,'requestpath' =>$branch_details->branch_slug,'create' =>'branch_profit_create']);
        // return view('user.profit_report.create');
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
        $this->validate($request, [
            'profit_name' => 'required',
            'profit_name' => 'required',
            'profit_name' => 'required',
            'profit_date' => 'required',
        ]);

        $store_profit_reports = new ProfitReport();
        $store_profit_reports->vendor_id = $get_auth_user->vendor_id;
        $store_profit_reports->branch_vendor_id = auth()->id();
        $store_profit_reports->branch_id = $get_auth_user->branch_id;
        $store_profit_reports->profit_name = $request->profit_name;
        $store_profit_reports->profit_amount = $request->profit_amount;
        $store_profit_reports->profit_date = $request->profit_date;
        $store_profit_reports->profit_description = $request->profit_description;
        $store_profit_reports->save();
        return redirect()->route('branch_profit_report.index')->with('success', "Profit has been added");
        dd($request->all());
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
        $branch_details=VendorBranch::where('id',auth()->user()->branch_id)->first();
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug,'requestpath' =>$branch_details->branch_slug,'create' =>'branch_profit_edit','id'=>$id]);
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
            'profit_name' => 'required',
            'profit_name' => 'required',
            'profit_name' => 'required',
            'profit_date' => 'required',
        ]);
        $store_profit_reports = ProfitReport::find($id);
        $store_profit_reports->profit_name = $request->profit_name;
        $store_profit_reports->profit_amount = $request->profit_amount;
        $store_profit_reports->profit_date = $request->profit_date;
        $store_profit_reports->profit_description = $request->profit_description;
        $store_profit_reports->save();
        return redirect()->route('branch_profit_report.index')->with('success', "Profit has been updated");
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
    public function branch_profit_report_delete($id){
        ProfitReport::find($id)->delete();
        session()->put("branch_profit_deleted",true);
        return redirect()->route('branch_profit_report.index')->with('success', "Profit has been deleted");
    }

    public function branch_profit_filter(Request $request){
        if($request->day == "" && $request->month == "" && $request->year == ""){
            session()->put("branch_profit_one_field_required",true);
            return back();
        }
        $branch_details=VendorBranch::where('id',auth()->user()->branch_id)->first();
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug,'requestpath' =>$branch_details->branch_slug,'create' =>'branch_profit_filter','day' => $request->day, 'month' => $request->month, 'year' => $request->year,]);

    }
}
