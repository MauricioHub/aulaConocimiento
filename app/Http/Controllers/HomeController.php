<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.2/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\EvaluacionUsers;
use App\Evaluacion;


/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth'); 
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {   
        $results = DB::select(

        'select count(ev.id) as result from taller as ta 
    inner join evaluacion as ev on (ev.taller_id = ta.id)
where ta.curso_id = 1');

        $user=Auth::user()->id;
        $results2 = DB::select('select count(evalus.id) as result2 from taller as ta 
    inner join evaluacion as ev on (ev.taller_id = ta.id)
    inner join evaluacion_users as evalus on (evalus.evaluacion_id = ev.id and evalus.users_id = ?)
where ta.curso_id = 1',[$user]);
       
        $total=$results[0]->result;
        $realizadas=$results2[0]->result2;

        $no_realizadas=$total-$realizadas;
        
        if($no_realizadas<0){
            $no_realizadas=0;
        }
        $collection = ([
            (object)['name' => 'Realizadas', 'value' => $realizadas],
            (object)['name' => 'No realizadas', 'value' => $no_realizadas]
         ]);
        $eval=null;
        if(EvaluacionUsers::all()->last()){
            $ultimo=EvaluacionUsers::all()->last()->evaluacion_id;
            $eval=Evaluacion::find($ultimo);
        }
        
        $tutoria='no existen secciones realizadas';
         if($eval){
         $tutoria=$eval->entaller->titulo;
         }
        return view('home',['pastel'=>$collection])->with('tutoria',$tutoria);
    }

}