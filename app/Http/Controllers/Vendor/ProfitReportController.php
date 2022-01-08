<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProfitReport;
use App\Exports\ProfitExport;
use Maatwebsite\Excel\Facades\Excel;

class ProfitReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "profit_report_index"]);
    }
      public function export()
    {
        return Excel::download(new ProfitExport, 'Profit_Report.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "profit_report_create"]);
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
            'profit_name' => 'required',
            'branch' => 'required',
            'profit_name' => 'required',
            'profit_name' => 'required',
            'profit_date' => 'required',
        ]);

        $store_profit_reports = new ProfitReport();
        $store_profit_reports->vendor_id = auth()->id();
        $store_profit_reports->branch_id = $request->branch;
        $store_profit_reports->profit_name = $request->profit_name;
        $store_profit_reports->profit_amount = $request->profit_amount;
        $store_profit_reports->profit_date = $request->profit_date;
        $store_profit_reports->profit_description = $request->profit_description;
        $store_profit_reports->save();

        return redirect()->route('profit_report.index')->with('success', "Profit has been added");
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "profit_report_edit", 'id' => $id]);
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
            'profit_name' => 'required',
            'branch' => 'required',
            'profit_name' => 'required',
            'profit_name' => 'required',
            'profit_date' => 'required',
        ]);

        $store_profit_reports = ProfitReport::find($id);
        $store_profit_reports->branch_id = $request->branch;
        $store_profit_reports->profit_name = $request->profit_name;
        $store_profit_reports->profit_amount = $request->profit_amount;
        $store_profit_reports->profit_date = $request->profit_date;
        $store_profit_reports->profit_description = $request->profit_description;
        $store_profit_reports->save();

        return redirect()->route('profit_report.index')->with('success', "Profit has been updated");
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
        ProfitReport::find($id)->delete();
        return redirect()->route('profit_report.index')->with('success', "Profit has been deleted");
    }

    public function profit_report_delete($id){
        ProfitReport::find($id)->delete();
        session()->put('profit_report_delete',true);
        return redirect()->route('profit_report.index')->with('success', "Profit has been deleted");
    }
    public function profit_report_filter(Request $request){
        if($request->day == "" && $request->month == "" && $request->year == "" && $request->branch == ""){
            session()->put("vendor_profit_one_fileld_required",true);
            return back();
        }

        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'day' => $request->day, 'month' => $request->month, 'year' => $request->year, 'branch_id' => $request->branch, 'requestpath' => "profit_report_filter"]);
    }
}
