<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaluacionUsers extends Model
{
	public $table = "evaluacion_users";
    public $fillable = ['fecha', 'puntuacion', 'users_id', 'evaluacion_id'];
    public $timestamps = false;

    public function inEvaluacion()
    {
        return $this->belongsTo('App\Evaluacion','evaluacion_id');
    }

    public function detallesEval() {

        return $this->hasMany('App\DetalleEvaluacion','evaluacionusers_id');
    }

    public function inUsers()
    {
        return $this->belongsTo('App\User');
    }

    // this is a recommended way to declare event handlers
    protected static function boot() {
        parent::boot();

        static::deleting(function($evaluser) { // before delete() method call this
             
             $evaluser->detallesEval()->delete();
             // do the rest of the cleanup...
        });
    }


}