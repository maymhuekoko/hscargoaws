<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWayPlanningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('way_plannings', function (Blueprint $table) {
            $table->id();
            $table->string('wayplan_no');
            $table->string('rider_name');
            $table->date('date');
            $table->string('time');
            $table->string('route_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('way_plannings');
    }
}
