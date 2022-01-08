<?php

namespace App\Http\Controllers\User;

use App\ExpensiveReport;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Vendor\PermissionId;
use App\Vendor\RolePermission;
use App\VendorBranch;
use App\Exports\BranchExpenseExport;
use Maatwebsite\Excel\Facades\Excel;

class BranchExpensiveReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branch_details=VendorBranch::where('id',auth()->user()->branch_id)->first();
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug,'requestpath' =>$branch_details->branch_slug,'create' =>'branch_expensive_report']);
    }


    public function export()
    {
        return Excel::download(new BranchExpenseExport, 'Expense_report.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branch_details=VendorBranch::where('id',auth()->user()->branch_id)->first();
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug,'requestpath' =>$branch_details->branch_slug,'create' =>'branch_expensive_report_create']);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $get_auth_user = User::find(auth()->id());
        $this->validate($request, [
            'expensive_name' => 'required',
            'expensive_amount' => 'required',
            'expensive_description' => 'required',
            'expensive_date' => 'required',
        ]);
        $store_expensive_reports = new ExpensiveReport();
        $store_expensive_reports->vendor_id = $get_auth_user->vendor_id;
        $store_expensive_reports->branch_vendor_id = auth()->id();
        $store_expensive_reports->branch_id = $get_auth_user->branch_id;
        $store_expensive_reports->expensive_name = $request->expensive_name;
        $store_expensive_reports->expensive_date = $request->expensive_date;
        $store_expensive_reports->expensive_amount = $request->expensive_amount;
        $store_expensive_reports->expensive_description = $request->expensive_description;
        $store_expensive_reports->save();
        return redirect()->route('branch_expensive_report.index')->with('success', 'Expensive amount created successfully');
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
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug,'requestpath' =>$branch_details->branch_slug,'create' =>'branch_expensive_report_edit','id'=>$id]);
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
            'expensive_name' => 'required',
            'expensive_amount' => 'required',
            'expensive_description' => 'required',
            'expensive_date' => 'required',
        ]);

        $update_expensive_report = ExpensiveReport::find($id);
        $update_expensive_report->expensive_name = $request->expensive_name;
        $update_expensive_report->expensive_date = $request->expensive_date;
        $update_expensive_report->expensive_amount = $request->expensive_amount;
        $update_expensive_report->expensive_description = $request->expensive_description;
        $update_expensive_report->save();
        return redirect()->route('branch_expensive_report.index')->with('success', 'Expensive amount updated successfully');

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
    public function branch_expensive_report_delete($id){
        ExpensiveReport::find($id)->delete();
        return redirect()->route('branch_expensive_report.index')->with('success', 'Expensive amount deleted successfully');
    }

    public function filterReports(Request $request)
    {
     if($request->day == "" && $request->month == "" && $request->year == ""){
         session()->put("branch_expensive_one_fileld_required",true);
         return back();
     }
        $branch_details=VendorBranch::where('id',auth()->user()->branch_id)->first();
        return redirect()->route('requestpath_create', ['slug' => Auth()->user()->laboratory_slug,'requestpath' =>$branch_details->branch_slug,'create' =>'branch_expensive_report_filter','day' => $request->day, 'month' => $request->month, 'year' => $request->year,]);

    }
}
