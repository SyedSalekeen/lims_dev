<?php

namespace App\Http\Controllers;

use App\ThemeChange;
use App\VendorBranch;
use Illuminate\Http\Request;

class ThemeChangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('requestpath', ['slug' => Auth()->user()->laboratory_slug, 'requestpath' => "theme_change"]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ThemeChange  $themeChange
     * @return \Illuminate\Http\Response
     */
    public function show(ThemeChange $themeChange)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ThemeChange  $themeChange
     * @return \Illuminate\Http\Response
     */
    public function edit(ThemeChange $themeChange)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ThemeChange  $themeChange
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ThemeChange $themeChange)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ThemeChange  $themeChange
     * @return \Illuminate\Http\Response
     */
    public function destroy(ThemeChange $themeChange)
    {
        //
    }
}
