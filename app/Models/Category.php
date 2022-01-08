<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $guarded = [];

     // relation to get shop name
     public function shop(){
        return $this->belongsTo('App\Models\Shop','shop_id');
    }
}
