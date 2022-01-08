<?php

namespace App\Vendor;

use Illuminate\Database\Eloquent\Model;
use App\VendorBranch;
use Spatie\Permission\Models\Role;
class RolePermission extends Model
{
    public function branch()

    {
        return $this->belongsTo(VendorBranch::class,'branch_id');

    }

    public function branch_name()

    {
        return $this->belongsTo(VendorBranch::class,'branch_id');

    }

    public function role_name()

    {
        return $this->belongsTo(Role::class,'role_id');

    }
}
