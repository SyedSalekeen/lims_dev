<?php

namespace App\Http\Controllers;

use App\TestGig;
use Illuminate\Http\Request;

class TestGigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "test_gig_index"]);
        // $get_test_gigs = TestGig::where('vendor_id',auth()->id())->get();
        // return view('vendor.test_gig.index',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "test_gig_create"]);
        // return view('vendor.test_gig.create');
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
            'test_name' => 'required',
            'test_amount' => 'required',
            'test_best_range' => 'required',
            'test_unit' => 'required',
            'branch' => 'required',
        ]);
        $check_gig_exist = TestGig::where('vendor_id', auth()->id())->where('test_name', $request->test_name)->first();
        if ($check_gig_exist) {
            session()->put('gig_already_exist', true);
            return redirect()->route('test_gig.index')
                ->with('success', 'Test Gig already exist');
        } else {
            $testGig = new TestGig();
            $testGig->vendor_id = auth()->id();
            $testGig->branch_id = $request->branch;
            $testGig->lab_test = $request->lab_test;
            $testGig->test_name = $request->test_name;
            $testGig->test_best_range = $request->test_best_range;
            $testGig->test_unit = $request->test_unit;
            $testGig->test_amount = $request->test_amount;
            $testGig->save();
            session()->put('gig_created', true);
            return redirect()->route('test_gig.index')
                ->with('success', 'Gig created successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TestGig  $testGig
     * @return \Illuminate\Http\Response
     */
    public function show(TestGig $testGig)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TestGig  $testGig
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "test_gig_edit", "id" => $id]);
        // $get_edit_gig = TestGig::find($id);
        // return view('vendor.test_gig.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TestGig  $testGig
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $this->validate($request, [
            'branch' => 'required',
            'test_name' => 'required',
            'test_amount' => 'required',
            'test_unit' => 'required',
        ]);
        $update_test_gig = TestGig::find($id);
        $update_test_gig->branch_id = $request->branch;
        $update_test_gig->lab_test = $request->lab_test;
        $update_test_gig->test_name = $request->test_name;
        $update_test_gig->test_best_range = $request->test_best_range;
        $update_test_gig->test_unit = $request->test_unit;
        $update_test_gig->test_amount = $request->test_amount;
        $update_test_gig->save();
        session()->put('gig_updated', true);
        return redirect()->route('test_gig.index')
            ->with('success', 'User edit successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TestGig  $testGig
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
    public function test_gig_delete($id)
    {
        $delete_gig = TestGig::where('id', $id)->first();
        $delete_gig->delete();
        session()->put('gig_deleted', true);
        return redirect()->route('test_gig.index')
            ->with('success', 'Gig deleted successfully');
    }
}
