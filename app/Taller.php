<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Taller extends Model
{
	public $table = "taller";
    public $fillable = ['titulo', 'duracion'];
    public $timestamps = false;

    public function recursos() {

        return $this->hasMany('App\Recurso')->orderBy('orden');
    }

    public function evaluaciones() {

        return $this->hasOne('App\Evaluacion');
    }


}