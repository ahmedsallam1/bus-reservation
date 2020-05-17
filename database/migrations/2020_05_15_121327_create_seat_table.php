<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reference');
            $table->integer('bus_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('seats', function($table) {
            $table
                ->foreign('bus_id')
                ->references('id')
                ->on('buses')
            ;
            $table->unique(['reference', 'bus_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seats');
    }
}
