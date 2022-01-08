<?php

namespace App\Http\Controllers\Vendor;

use App\AddTest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BarCodeController extends Controller
{
    public function vendor_bar_code_details(Request $request)
    {
        // dd($request->all());
        $get_test = AddTest::where("id",$request->id)->get();
        return ["data" => $get_test];
    }
}
