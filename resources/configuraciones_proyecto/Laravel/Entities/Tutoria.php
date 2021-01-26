<?php namespace Modules\Robotica\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Tutoria extends Model {

    //cliente_resource
	protected $table='tutoria';

	// Eloquent asume que cada tabla tiene una clave primaria con una columna llamada id.
	// Si éste no fuera el caso entonces hay que indicar cuál es nuestra clave primaria en la tabla:
	protected $primaryKey = 'id';

	// Atributos que se pueden asignar de manera masiva.
	protected $fillable = array('nombre','capitulo','estado');

	// Aquí ponemos los campos que no queremos que se devuelvan en las consultas.
	protected $hidden = ['created_at','updated_at'];

	public function deTutoriaresource()
	{
		// $this hace referencia al objeto que tengamos en ese momento.
		return $this->hasMany('App\DetTutoria');
	}

}