<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Taller;
use App\Recurso;

class TallerController extends Controller
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
        $items = Taller::orderBy('id','ASC')->paginate(5);
        return view('taller.index',compact('items'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function listar(Request $request)
    {
        $items = Taller::orderBy('id','ASC')->paginate(5);
        return view('taller.index2',compact('items'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

       
        return view('taller.create');
    }

    public function realizar($id)
    {
        $item = Taller::find($id);

        return view('taller.realizar',compact('item'));
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
            
            'titulo' => 'required'
        ]);
 
        if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }

        $this->validate($request, [
            'titulo' => 'required',
        ]);

        Taller::create($request->all());
        return redirect()->route('taller.index')
                        ->with('success','Taller guardado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $item = Taller::find($id);
        return view('taller.show',compact('item'));
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */ 
    public function edit($id)
    {
        $item = Taller::find($id);
        return view('taller.editar_taller',compact('item'));
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
         $v = \Validator::make($request->all(), [
            
            'titulo' => 'required'
        ]);
 
        if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }

        $this->validate($request, [
            'titulo' => 'required',
        ]);

        Taller::find($id)->update($request->all());
        return redirect()->route('taller.index')
                        ->with('success','Taller actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
*/   
    public function destroy($id)
    {
        Taller::find($id)->delete();
        return redirect()->route('taller.index')
                        ->with('success','Taller eliminado correctamente');
    }


}