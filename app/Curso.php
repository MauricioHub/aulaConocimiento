<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Curso extends Model
{
	public $table = "curso";
    public $fillable = ['nombre','descripcion','duracion','fecha_inicio','fecha_fin','id_profesor'];
    public $timestamps = false;
    
}