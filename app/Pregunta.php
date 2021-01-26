<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Pregunta extends Model
{
	public $table = "pregunta";
    public $fillable = ['enunciado','rutaImagen','tipopregunta','evaluacion_id'];
    public $timestamps = false;

    
    public function inEvaluacion()
    {
        return $this->belongsTo('App\Evaluacion');
    }

    public function respuestas() {

        return $this->hasMany('App\Respuesta');
    }

     public function detalleEval() {

         return $this->hasMany('App\DetalleEvaluacion');
    }

    // this is a recommended way to declare event handlers
    protected static function boot() {
        parent::boot();

        static::deleting(function($pregunta) { // before delete() method call this
             
             $pregunta->detalleEval()->delete();
             $pregunta->respuestas()->delete();
             // do the rest of the cleanup...
        });
    }

   
    
}