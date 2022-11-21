<?php

namespace App;

use App\WayPlanSchedule;
use Illuminate\Database\Eloquent\Model;

class WayPlanning extends Model
{
    //
    protected $fillable = [
            'wayplan_no',
            'rider_name',
            'date',
            'start_time',
            'end_time',
            'route_name',
            'way_id',
            'remark',
            'way_plan_schedule_id',
    ];

}
