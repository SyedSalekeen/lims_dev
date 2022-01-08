<?php

namespace App;
use App\AddTestDetail;
use Illuminate\Database\Eloquent\Model;

class TestGig extends Model
{
    public function gig_name_table()
    {
        return $this->hasMany(AddTestDetail::class, 'gig_id');
    }
}
