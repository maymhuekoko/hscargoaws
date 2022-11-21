<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ways', function (Blueprint $table) {
            $table->id();
            $table->string('way_no');
            $table->date('date');
            $table->string('rider_name');
            $table->string('start_time');
            $table->string('end_time');
            $table->integer('total_order')->nullable();
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
        Schema::dropIfExists('ways');
    }
}
