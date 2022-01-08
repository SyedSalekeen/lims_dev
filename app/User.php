<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use  Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function branch()

    {
        return $this->belongsTo(VendorBranch::class, 'branch_id');
    }
    public function get_branch_name()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }
    public function patient()
    {
        return $this->hasMany(AddTest::class, 'patient_mr_no');
    }

    public function laboratary_name()

    {
        return $this->hasMany(AddTest::class, 'vendor_id');
    }
    public function vendorbranch()
    {
        return $this->belongsTo(VendorBranch::class, 'vendor_id');
    }

    public function get_patient()
    {
        return $this->hasMany(AddTestReport::class, 'patient_id');
    }

 
}
