<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddTestReport extends Model
{
    public function get_patient_name()

    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function get_branch_name()

    {
        return $this->belongsTo(VendorBranch::class, 'branch_id');
    }
}
