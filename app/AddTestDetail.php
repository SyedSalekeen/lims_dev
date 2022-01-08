<?php

namespace App;
use App\TestGig;
use Illuminate\Database\Eloquent\Model;

class AddTestDetail extends Model
{
    public function get_gig_name()

    {
        return $this->belongsTo(TestGig::class,'gig_id');

    }
}
