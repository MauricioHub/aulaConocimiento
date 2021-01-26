<?php namespace Modules\Robotica\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class RoboticaController extends Controller {
	
	public function index()
	{
		return view('robotica::index');
	}
	
}