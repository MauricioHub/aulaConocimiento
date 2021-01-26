<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEv3Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ev3', function ($table) {
            $table->increments('id');
            $table->integer('id_padre');
            $table->string('titulo');
            $table->string('descripcion');
            $table->string('fuente');
            $table->boolean('visible');
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
        if (Schema::hasTable('ev3')) {
            Schema::drop('ev3');
        };
    }
}
