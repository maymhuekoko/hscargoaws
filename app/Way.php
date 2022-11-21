<?php

namespace App;

use App\WayPlanning;
use Illuminate\Database\Eloquent\Model;

class Way extends Model
{
    //
    protected $fillable = [
        'way_no',
        'date',
        'rider_name',
        'start_time',
        'end_time',
        'total_order'
    ];
    protected $with = ['way_plannings'];
    function way_plannings(){
        return $this->hasMany(WayPlanning::class);
    }
}
