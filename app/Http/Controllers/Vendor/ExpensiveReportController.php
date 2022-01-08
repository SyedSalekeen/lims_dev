<?php

namespace App\Http\Controllers\Vendor;

use App\ExpensiveReport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;

class ExpensiveReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "expensive_report_index"]);
        // return view('vendor.expensive_report.index');
    }


    // ali function

    public function export()
    {
        return Excel::download(new ReportExport, 'Expense_report.xlsx');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "expensive_report_create"]);
        // $get_vendor_branch = VendorBranch::where('vendor_id', auth()->id())->where('delete_status', '0')->where('status', '1')->get();
        // return view('vendor.expensive_report.create',get_defined_vars());
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
        $this->validate($request, [
            'expensive_name' => 'required',
            'branch' => 'required',
            'expensive_amount' => 'required',
            'expensive_description' => 'required',
            'expensive_date' => 'required',
        ]);
        $store_expensive_reports = new ExpensiveReport();
        $store_expensive_reports->vendor_id = auth()->id();
        $store_expensive_reports->branch_id = $request->branch;
        $store_expensive_reports->expensive_name = $request->expensive_name;
        $store_expensive_reports->expensive_date = $request->expensive_date;
        $store_expensive_reports->expensive_amount = $request->expensive_amount;
        $store_expensive_reports->expensive_description = $request->expensive_description;
        $store_expensive_reports->save();
        session()->put('expensive_report_store', true);
        return redirect()->route('epensive_report.index');
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
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "expensive_report_edit", 'id' => $id]);
        // dd($id);
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
            'branch' => 'required',
            'expensive_amount' => 'required',
            'expensive_description' => 'required',
            'expensive_date' => 'required',
        ]);

        $update_expensive_report = ExpensiveReport::find($id);
        // dd($request->all());
        $update_expensive_report->branch_id = $request->branch;
        $update_expensive_report->expensive_name = $request->expensive_name;
        $update_expensive_report->expensive_date = $request->expensive_date;
        $update_expensive_report->expensive_amount = $request->expensive_amount;
        $update_expensive_report->expensive_description = $request->expensive_description;
        $update_expensive_report->save();
        session()->put('expensive_report_updated', true);
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "expensive_report_index"]);
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

    public function epensive_report_delete($id)
    {
        ExpensiveReport::find($id)->delete();
        session()->put('expensive_report_deleted', true);
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "expensive_report_index"]);
    }

    public function filterReports(Request $request)
    {
        if($request->day == "" && $request->month == "" && $request->year == "" && $request->branch == ""){
            session()->put("vendor_expensive_one_fileld_required",true);
            return back();
        }


        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'day' => $request->day, 'month' => $request->month, 'year' => $request->year, 'branch_id' => $request->branch, 'requestpath' => "expensive_report_filter"]);
        // $day = $request->day;
        // $month = $request->month;
        // $year = $request->year;
        // if ($request->has('month') && $request->has('day') && $request->has('year')) {
        //     $monthData =  ExpensiveReport::whereRaw('YEAR(created_at) = '.$year)->whereRaw('MONTH(created_at) = '.$month)->whereRaw('DAY(created_at) = '.$day)->get();
        //  }
        //  else if ($request->has('month') && $request->has('year')) {

        //     $monthData =  ExpensiveReport::whereRaw('MONTH(created_at) = '.$month)->whereRaw('YEAR(created_at) = '.$year)->get();
        //  }
        //  else if ($request->has('day')) {
        //     $monthData =  ExpensiveReport::whereRaw('DAY(created_at) = '.$day)->get();
        //  }

    }
}
