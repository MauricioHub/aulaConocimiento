<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Recurso;
use App\Taller;

class RecursoController extends Controller
{

   
   public function __construct()
    {
        $this->middleware('auth'); 
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
            'descripcion' => 'required',
            'file' => 'mimes:jpeg,bmp,png,gif,mp4,pdf,jpg|max:4000'
        ]);
        

//subir archivos

        //guardar archivo no olvidar q form debe ser multipart
        $file = $request->file('file');
       
        if ($file)
            {
                 $nombreobjor = $file->getClientOriginalName();
                $nombreobj=strtr($nombreobjor,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ',
'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
        //configurar ruta local en config-->filisystem
        \Storage::disk('local')->put($nombreobj, \File::get($file));

        $request['archivo']=$nombreobj;

                $extension=substr( $nombreobj , -4);
                $request['extension']=$extension;
                $narchivo=$nombreobj;
                $narchivo=substr($narchivo, 0,strlen($narchivo)-4);
                $request['nombre_archivo']=$narchivo;
            }

        Recurso::create($request->all());
        return redirect()->route('taller.show',[$request->taller_id])
                        ->with('success','Actividad creada exitosamente');

                        //<a class="btn btn-info" href="{{ route('taller.show',$item->id) }}">
    }

   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */ 
    public function edit($id)
    {
        $item = Recurso::find($id);
        return view('taller.editar_actividad',compact('item'));
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
            'file' => 'mimes:jpeg,bmp,png,gif,mp4,pdf,jpg|max:4000'
        ]);
         $t=Recurso::find($id)->taller_id;



        $file = $request->file('file');
       
        if ($file)
            {
                $nombreobjor = $file->getClientOriginalName();
                $nombreobj=strtr($nombreobjor,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ',
'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
        //configurar ruta local en config-->filisystem
        \Storage::disk('local')->put($nombreobj, \File::get($file));

        $request['archivo']=$nombreobj;

                $extension=substr( $nombreobj , -4);
                $request['extension']=$extension;
                $narchivo=$nombreobj;
                $narchivo=substr($narchivo, 0,strlen($narchivo)-4);
                $request['nombre_archivo']=$narchivo;
            }


        Recurso::find($id)->update($request->all());
        return redirect()->route('taller.show',$t)
                        ->with('success','Actividad editada exitosamente');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
*/   
    public function destroy($id)
    {
       $t=Recurso::find($id)->taller_id;
        $filename= Recurso::find($id)->archivo;
        Storage::delete($filename);
        Recurso::find($id)->delete();
        return redirect()->route('taller.show', $t)
                        ->with('success','Actividad eliminada correctamente');
    }


}