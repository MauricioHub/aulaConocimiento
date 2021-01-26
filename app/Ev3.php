<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Ev3 extends Model 
{
	public $table = "introev3";
	public $fillable= ['id_menu', 'ruta'];
	public $timestamps = true;
}