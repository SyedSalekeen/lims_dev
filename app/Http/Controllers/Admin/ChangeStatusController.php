<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class ChangeStatusController extends Controller
{
    public function vendor_change_status(Request $request)
    {
        $changeStatus = User::find($request->user_id);
        $changeStatus->status = $request->status;
        $changeStatus->save();
        return ["data"=> "true"];
    }
}
