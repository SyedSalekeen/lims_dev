<?php

namespace App\Vendor;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
class PermissionId extends Model
{
    public function get_permission_name()
    {
        return $this->belongsTo(Permission::class,'permission_id');
    }
}
