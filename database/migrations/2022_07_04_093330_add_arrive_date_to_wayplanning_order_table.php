<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddArriveDateToWayplanningOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wayplanning_order', function (Blueprint $table) {
            //
            $table->string('arrive_date')->nullable();
            $table->string('arrive_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wayplanning_order', function (Blueprint $table) {
            //
        });
    }
}
