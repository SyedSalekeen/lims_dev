<?php

namespace App;

use App\Vendor\RolePermission;
use Illuminate\Database\Eloquent\Model;
use App\AddTest;

class VendorBranch extends Model
{
    public function branch_name()

    {
        return $this->hasMany(VendorBranchRole::class, 'branch_id');
    }

    public function branch_id()

    {
        return $this->hasMany(User::class, 'branch_id');
    }


    public function users()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }
    public function branch_permission_name()

    {
        return $this->hasMany(RolePermission::class, 'branch_id');
    }
    public function add_test_branch_name()
    {
        return $this->hasMany(AddTest::class, 'branch_id');
    }

    public function get_branch_add_test_report()
    {
        return $this->hasMany(AddTestReport::class, 'branch_id');
    }
}
