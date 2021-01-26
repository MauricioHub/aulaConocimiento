<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Curso;


class CursoController extends Controller
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
        $items = Curso::orderBy('id')->paginate(5);
        return view('curso.index',compact('items'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */ 
    public function create()
    {
        return view('curso.crear_curso');
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = \Validator::make($request->all(), [
            'nombre' => 'required'
        ]);
        if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }

        $request->fecha_inicio=null;
        $request->fecha_fin=null;
        $request->id_profesor='1';


        Curso::create($request->all());
        return redirect()->route('curso.index')
                        ->with('success','Item created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    
    public function edit($id)
    {
        $item = Curso::find($id);
        return view('Curso.editar_curso',compact('item'));
    }
*/ 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $v = \Validator::make($request->all(), [
            'nombre' => 'required'
        ]);
        if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }

        Curso::find($id)->update($request->all());
        return redirect()->route('curso.index')
                        ->with('success','Curso actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
 */ 
    public function destroy($id)
    {
        Curso::find($id)->delete();
        return redirect()->route('curso.index')
                        ->with('success','Curso eliminado correctamente');
    }
 

}