<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RoboticaTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

         \DB::statement('SET FOREIGN_KEY_CHECKS=0');

            Schema::dropIfExists('detalle_puntuacion');
            Schema::dropIfExists('curso_estudiante');
            Schema::dropIfExists('puntuacion');
            Schema::dropIfExists('evaluacion');
            Schema::dropIfExists('estudiante');
            Schema::dropIfExists('recurso');
            Schema::dropIfExists('respuesta');
            Schema::dropIfExists('pregunta');
            Schema::dropIfExists('taller');
            Schema::dropIfExists('curso');

        \DB::statement('SET FOREIGN_KEY_CHECKS=1');




        Schema::create('curso', function (Blueprint $table) {

            $table->increments('id');
            $table->string('nombre');
            $table->string('descripcion');
            $table->integer('duracion')
            $table->date('fecha_inicio');
            $table->date('fecha_fin');

            $table->boolean('estado');
            $table->timestamps();
            $table->softDeletes();

        });


        Schema::create('estudiante', function (Blueprint $table) {

            $table->increments('id');
            $table->string('apellidos');
            $table->string('nombres');
            $table->string('cedula')
            $table->string('direccion');
            $table->date('fecha_nacimiento');

            $table->boolean('estado');
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('curso_estudiante', function (Blueprint $table) {

            $table->increments('id');
            $table->dateTime('fecha_registro');
            $table->float('calificacion',8,2);
            $table->integer('estudiante_id')->unsigned();
            $table->integer('curso_id')->unsigned();

            $table->boolean('estado');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('estudiante_id')
                  ->references('id')->on('estudiante')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('curso_id')
                  ->references('id')->on('curso')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });


        Schema::create('taller', function (Blueprint $table) {

            $table->increments('id');
            $table->string('titulo');
            $table->integer('duracion');
            $table->integer('curso_id')->unsigned();

            $table->boolean('estado');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('curso_id')
                  ->references('id')->on('curso')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });


        Schema::create('recurso', function (Blueprint $table) {

            $table->increments('id');
            $table->string('nombre_archivo');
            $table->string('ruta');
            $table->string('link');
            $table->string('archivo');
            $table->string('extension');
            $table->string('descripcion');
            $table->integer('orden');
            $table->integer('taller_id')->unsigned();

            $table->boolean('estado');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('taller_id')
                  ->references('id')->on('taller')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });


        Schema::create('pregunta', function (Blueprint $table) {

            $table->increments('id');
            $table->string('enunciado');
            $table->integer('taller_id')->unsigned();

            $table->boolean('estado');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('taller_id')
                  ->references('id')->on('taller')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });


        Schema::create('respuesta', function (Blueprint $table) {

            $table->increments('id');
            $table->string('respuesta');
            $table->integer('pregunta_id')->unsigned();

            $table->boolean('estado');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('pregunta_id')
                  ->references('id')->on('pregunta')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });


        Schema::create('evaluacion', function (Blueprint $table) {

            $table->increments('id');
            $table->dateTime('fecha');
            $table->string('tiempo');
            $table->integer('taller_id')->unsigned();

            $table->boolean('estado');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('taller_id')
                  ->references('id')->on('taller')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });


        Schema::create('puntuacion', function (Blueprint $table) {

            $table->increments('id');
            $table->string('descripcion');
            $table->integer('calificacion');
            $table->dateTime('fecha');
            $table->integer('duracion_examen');

            $table->boolean('estado');
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('detalle_puntuacion', function (Blueprint $table) {

            $table->increments('id');
            $table->string('pregunta');
            $table->string('respuesta_asociada');
            $table->integer('evaluacion_id')->unsigned();
            $table->integer('estudiante_id')->unsigned();
            $table->integer('puntuacion_id')->unsigned();

            $table->boolean('estado');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('evaluacion_id')
                  ->references('id')->on('evaluacion')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('estudiante_id')
                  ->references('id')->on('estudiante')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('puntuacion_id')
                  ->references('id')->on('puntuacion')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('detalle_puntuacion');
        Schema::dropIfExists('curso_estudiante');
        Schema::dropIfExists('puntuacion');
        Schema::dropIfExists('evaluacion');
        Schema::dropIfExists('estudiante');
        Schema::dropIfExists('recurso');
        Schema::dropIfExists('respuesta');
        Schema::dropIfExists('pregunta');
        Schema::dropIfExists('taller');
        Schema::dropIfExists('curso');
            
    }
}
