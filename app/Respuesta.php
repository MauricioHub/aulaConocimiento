<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Respuesta extends Model
{
	public $table = "respuesta";
    public $fillable = ['respuesta','es_correcta','rutaImagen','pregunta_id'];
    public $timestamps = false;

    public function inPregunta()
    {
        return $this->belongsTo('App\Pregunta');
    }

     public function detalleEval() {

         return $this->hasMany('App\DetalleEvaluacion','respuesta_seleccionada_id');
    }

    // this is a recommended way to declare event handlers
    protected static function boot() {
        parent::boot();

        static::deleting(function($respuesta) { // before delete() method call this
             
             $respuesta->detalleEval()->delete();
             // do the rest of the cleanup...
        });
    }
    
}