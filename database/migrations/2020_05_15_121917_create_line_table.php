<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lines', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('origin_id')->unsigned();
            $table->integer('destination_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('lines', function($table) {
            $table
                ->foreign('origin_id')
                ->references('id')
                ->on('stations')
                ->onDelete('cascade')
            ;
            $table
                ->foreign('destination_id')
                ->references('id')
                ->on('stations')
                ->onDelete('cascade')
            ;
            $table->unique(['origin_id', 'destination_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lines');
    }
}
