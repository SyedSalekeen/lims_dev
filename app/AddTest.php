<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\VendorBranch;

class AddTest extends Model
{
    public function branch()

    {
        return $this->belongsTo(VendorBranch::class,'branch_id');

    }

    public function patientName()

    {
        return $this->belongsTo(User::class,'patient_mr_no');

    }

    public function get_vendor_laboratary_name()

    {
        return $this->belongsTo(User::class,'vendor_id');

    }
}
