<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trip_id')->unsigned();
            $table->integer('seat_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->unique(['trip_id', 'seat_id']);
        });

        Schema::table('reservations', function($table) {
            $table
                ->foreign('trip_id')
                ->references('id')
                ->on('trips')
            ;
            $table
                ->foreign('seat_id')
                ->references('id')
                ->on('seats')
            ;
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
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
        Schema::dropIfExists('reservations');
    }
}
