<?php
namespace App;

use Illuminate\Database\Eloquent\Model;


class Recurso extends Model
{
	public $table = "recurso";
    public $fillable = ['orden','nombre_archivo','descripcion','ruta','link','archivo', 'extension','taller_id'];
    public $timestamps = false;

    public function talleres()
    {
        return $this->belongsTo('App\Taller');
    }

}