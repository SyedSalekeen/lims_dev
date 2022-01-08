<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorBranchRole extends Model
{
    public function role()

    {
        return $this->belongsTo(VendorBranch::class,'branch_id');

    }
}
