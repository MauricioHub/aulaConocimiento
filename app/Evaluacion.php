<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
	public $table = "evaluacion";
    public $fillable = ['nombre','fecha', 'tiempo', 'taller_id'];
    public $timestamps = false;

    public function entaller()
    {
        return $this->belongsTo('App\Taller','taller_id');
    }

    public function preguntas() {

        return $this->hasMany('App\Pregunta')->orderByRaw("RAND()")->take(5);
    }

     public function preguntas2() {

        return $this->hasMany('App\Pregunta');
    }

    public function evalUsers() {
        return $this->hasMany('App\EvaluacionUsers');
    }

    // this is a recommended way to declare event handlers
    protected static function boot() {
        parent::boot();

        static::deleting(function($evaluacion) { // before delete() method call this
             
             $evaluacion->preguntas2()->delete();
             $evaluacion->evalUsers()->delete();
             // do the rest of the cleanup...
        });
    }


}