<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleEvaluacion extends Model
{
	public $table = "detalle_evaluacion";
    public $fillable = ['respuesta_id', 'pregunta_id', 'evaluacionusers_id'];
    public $timestamps = false;

    
     public function inEvaluser()
    {
        return $this->belongsTo('App\EvaluacionUser','evaluacionusers_id');
    }

    public function inPregunta()
    {
        return $this->belongsTo('App\Pregunta','pregunta_id');
    }

     public function inRespuesta()
    {
        return $this->belongsTo('App\Respuesta','respuesta_seleccionada_id');
    }

}