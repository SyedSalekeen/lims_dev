<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'name',
        'employee_name',
        'location',
        'address',
        'phone',
        'garage',
        'status'
    ];

    // relationship with the articles table
    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }

    // relationship with the Category table
    public function category()
    {
        return $this->hasMany('App\Models\Category');
    }

}
