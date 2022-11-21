<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWayplanningFlagToWayPlanSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('way_plan_schedules', function (Blueprint $table) {
            //
            $table->integer('wayplanning_flag')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('way_plan_schedules', function (Blueprint $table) {
            //
        });
    }
}
