<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripStopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_stops', function (Blueprint $table) {
            $table->id();
            $table->integer('trip_id')->unsigned();
            $table->integer('line_id')->unsigned();

            $table->timestamps();
        });

        Schema::table('trip_stops', function($table) {
            $table
                ->foreign('trip_id')
                ->references('id')
                ->on('trips')
            ;
            $table
                ->foreign('line_id')
                ->references('id')
                ->on('lines')
            ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_stop');
    }
}
