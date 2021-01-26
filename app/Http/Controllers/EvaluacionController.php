<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Evaluacion;
use App\Taller;
use App\Pregunta;
use App\Respuesta;
use App\EvaluacionUsers;
use App\DetalleEvaluacion;
use App\User;
use PDF;
use DB;

use Auth;

class EvaluacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = Evaluacion::orderBy('id','ASC')->paginate(5);
        $talleres = Taller::lists('titulo','id');

        return view('evaluacion.index',compact('items','talleres'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required',
        ]);

        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        $request->fecha= $date;
        //printf( $date);
        //printf( $request->fecha);
        $e=Evaluacion::create($request->all());
        $e->fecha= $date;
        $e->save();
        return redirect()->route('evaluacion.index')
                     ->with('success','Evaluacion guardada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */   
    public function destroy($id)
    {
        Evaluacion::find($id)->delete();
        return redirect()->route('evaluacion.index')
                        ->with('success','Evaluacion eliminada correctamente');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
       
    }

     



     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $this->validate($request, [
            'nombre' => 'required',
        ]);

        Evaluacion::find($id)->update($request->all());
        return redirect()->route('evaluacion.index')
                        ->with('success','Evaluacion actualizada correctamente');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function realizar($id)
    {   
        //$user=Auth::user()->id;

        $carbon = new \Carbon\Carbon();
        $date = $carbon->now(-5);
        //$cal=0;
        $titulo=Taller::find($id)->titulo;
        $evaluacion=Taller::find($id)->evaluaciones;

        //print_r($evaluacion->preguntas);

        if(count($evaluacion->preguntas) < 1){
            //printf('si tengo');
            $error='No hay preguntas disponibles para esta evaluacion';
            return view('evaluacion.mensaje_error',compact('id','error'));
        }
        //printf('yo tambien');
        $evaluser=new EvaluacionUsers();

        $evaluser->evaluacion_id=$evaluacion->id;
        $evaluser->users_id=Auth::user()->id;
        $evaluser->fecha= $date;
        $evaluser->puntuacion=0;
        $evaluser->save();

        //printf("haciendo evaluacion(id eval):$evaluacion->id de(id user):$user  el dia(date):$date su calificacion es(int):$cal ");
    
        $aleatorio=$evaluacion->preguntas;
        $array=[];
        $i=0;
        foreach ($aleatorio as $pregunta) {

            $detEval=new DetalleEvaluacion();
            $detEval->pregunta_id=$pregunta->id;
            $detEval->evaluacionusers_id=$evaluser->id;
            $detEval->respuesta_seleccionada_id=null;
            $detEval->save();
            $array[$i]= $detEval->id;
            $i++;

            
        }

        $id_eval=$evaluser->id;
        
        //print_r($array);

        return view('evaluacion.realizar_evaluacion',compact('aleatorio','id','id_eval','array','titulo'));
        

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardarEvaluacion(Request $request)
    {
       
        
        $i=$request->pregunta;
        $calificacion=0;
        if($i){
            foreach ($i as $item) {
                //printf("$item ");
                $pregid=strstr($item, 'nn',true);
                $itemid=substr(strstr($item, 'nn'),2);
                //printf(" $pregid ");
                $respuesta=Respuesta::find($itemid);
                $pregunta=Pregunta::find($respuesta->pregunta_id);

                if ($respuesta->es_correcta) {
                    $calificacion=$calificacion+1;
                }

                $pseleccionada=DetalleEvaluacion::find($pregid);
                $pseleccionada->respuesta_seleccionada_id=$respuesta->id;
                $pseleccionada->save();

                //printf("\n la pregunta fue $pregunta->enunciado y su respuesta fue $respuesta->respuesta");
            }  
        }
        $id=$request->id_eval;
        $evaluacion=EvaluacionUsers::find($id);

        $evaluacion->puntuacion=$calificacion;
        $evaluacion->save();

            $items=$evaluacion->detallesEval;
            //return view('evaluacion.visualizar_prueba',compact('items','id','calificacion'));
            return redirect()->route('ver_prueba',['id' => $id]);

        //printf("Su calificacion es: $cal salir");
       
    }

/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function resumen_evaluaciones()
    {  
        $user=User::find(Auth::user()->id);
        $items=$user->evalUsers()->paginate(10);
        //$items=EvaluacionUsers::$items->orderBy('id','DESC')->paginate(5);
        // $items = EvaluacionUsers::orderBy('id','DESC')->paginate(5);
        //$users = User::where('votes', '>', 100)->paginate(15);

        return view('evaluacion.resumen_evaluaciones',compact('items'));
        //print_r($items);
            
    }  

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function ver_prueba($id)
    {  
            $evaluser=EvaluacionUsers::find($id);
            $titulo=$evaluser->inEvaluacion->enTaller->titulo;
            //printf($eval);
            //$tall=Taller::$eval->enTaller;
            $calificacion=$evaluser->puntuacion;
            $items=$evaluser->detallesEval;
            //printf("prueba $id");
            return view('evaluacion.visualizar_prueba',compact('items','id','calificacion','titulo'));
           // foreach ($items as $item) {
             //  printf($item->inPregunta->id);
            //}
            //print_r($items);
    }  

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfview($id)
    {
       // $items = DB::table("items")->get();
       // view()->share('items',$items);

            $evaluser=EvaluacionUsers::find($id);
            $items=$evaluser->detallesEval;

            $pdf = PDF::loadView('evaluacion.visualizar_prueba',compact('items','id'))->save( 'pdfname.pdf' ); 
            //return $pdf->download('prueba.pdf');
            //->save( 'path/pdfname.pdf' ); 
        

       // return view('pdfview');
    }

}