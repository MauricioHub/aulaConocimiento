<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoboticaTables extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('rol', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->boolean('estado');
            $table->timestamps();
        });
        
        Schema::create('usuario', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rol_id')->unsigned();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('email')->unique();
            $table->boolean('estado');
            $table->timestamps();
            
            $table->foreign('rol_id')
                  ->references('id')
                  ->on('rol')
                  ->update('cascade')
                  ->delete('cascade');
        });
        
        Schema::create('tutoria', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('capitulo');
            $table->boolean('estado');
            $table->timestamps();
        });
        
        Schema::create('det_test', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pregunta');
            $table->string('respuesta');
            $table->boolean('estado');
            $table->timestamps();
        });
        
        Schema::create('test', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('det_test_id')->unsigned();
            $table->string('titulo');
            $table->string('respuesta_estudiante');
            $table->boolean('estado');
            $table->timestamps();
            
            $table->foreign('det_test_id')
                  ->references('id')
                  ->on('det_test')
                  ->update('cascade')
                  ->delete('cascade');
        });
        
        Schema::create('det_tutoria', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion');
            $table->integer('usuario_id')->unsigned();
            $table->integer('tutoria_id')->unsigned();
            $table->integer('test_id')->unsigned();
            $table->integer('nota');
            $table->boolean('estado');
            $table->timestamps();
            
            $table->foreign('usuario_id')
                  ->references('id')
                  ->on('usuario')
                  ->update('cascade')
                  ->delete('cascade');
                  
            $table->foreign('tutoria_id')
                  ->references('id')
                  ->on('tutoria')
                  ->update('cascade')
                  ->delete('cascade');
                  
            $table->foreign('test_id')
                  ->references('id')
                  ->on('test')
                  ->update('cascade')
                  ->delete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('det_tutoria');
    }

}
