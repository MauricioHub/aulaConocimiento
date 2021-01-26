@extends('layouts.app')

@section('contentheader_title')
     Mantenimiento de Cursos
@endsection


@section('main-content')

    <div class="row" style="width : 80%; margin : 0 auto;">
        </br><div class="col-lg-12 margin-tb">
            
            <div class="pull-right">
                <a class="btn btn-success" data-toggle="modal" data-target="#myModal">
                  <span class="glyphicon glyphicon-plus"></span> Crear Curso
                 </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if($errors->has())
        <div class="alert alert-warning" role="alert">
           @foreach ($errors->all() as $error)
              <div>{{ $error }}</div>
          @endforeach
        </div>
    @endif </br>
    
</br>
    <table class="table table-bordered" style="width : 80%; margin : 0 auto;">
        <tr>
            <th>No</th>
            <th>Nombre</th>
            <th width="600px">Descripcion</th>     
             
            <th width="200px">Fecha_Inicio</th>
            <th width="200px">Fecha_Fin</th>  
             
            <th width="400px">Acciones</th>
        </tr>

    @foreach ($items as $key => $item)
    <tr>
        
        <td>{{ ++$i }}</td>
        <td>{{ $item->nombre }}</td>
        <td>{{ $item->descripcion }}</td>
        
        <td>{{ $item->fecha_inicio }}</td>
        <td>{{ $item->fecha_fin }}</td>
        

        <td>
            
            {{--<a class="btn btn-info" href="{{ route('curso.edit',$item->id) }}">Editar</a>--}}
            <a class="btn btn-info" data-toggle="modal" data-target="#editcurso{{ $item->id }}"> 
                <span class="glyphicon glyphicon-pencil"></span>
            </a>
            <a class="btn btn-danger" data-toggle="modal" data-target="#ecurso{{ $item->id }}"> 
                <span class="glyphicon glyphicon-remove"></span>
            </a>        
            <!-- Modal editar -->
            <div>
                        <div class="modal fade" id="editcurso{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Editar Curso</h4>
                                </div>
                                

                                <div class="modal-body">
                                    {!! Form::model($item, ['method' => 'PATCH','route' => ['curso.update', $item->id]]) !!}
                                    <div class="row">

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                                <strong>Nombre:</strong>
                                                {!! Form::text('nombre', null, array('placeholder' => 'nombre','class' => 'form-control'),['class' => 'form-control' , 'required' => 'required']) !!}
                                            
                                        </div>
                                    </div>
                                    
                                   <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Descripcion:</strong>
                                            {!! Form::text('descripcion', null, array('placeholder' => 'descripcion','class' => 'form-control'),['class' => 'form-control' , 'required' => 'required']) !!}
                                        </div>
                                    </div>

                                    

                                    

                                    </div>
                                </div>
                                
                                <div class="modal-footer">
                                     <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                                     {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                                    {!! Form::close() !!}
                                </div>
                              
                            </div>
                          </div>
                        </div>

            </div>

            <!-- Modal eliminar -->
            <div>
                <div class="modal fade" id="ecurso{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Confirmar eliminación</h4>
                        </div>
                        
                      <div class="modal-footer">
                         {!! Form::open(['method' => 'DELETE','route' => ['curso.destroy', $item->id],'style'=>'display:inline']) !!}
                         <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                         {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                      </div>
                      
                    </div>
                  </div>
                </div>
            </div>
        </td>
    </tr>
    @endforeach
    </table>




<!-- Modal Nuevo Curso-->
<div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Nuevo Curso</h4>
        </div>
        <div class="modal-body">

            {!! Form::open(array('route' => 'curso.store','method'=>'POST')) !!}
                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {!! Form::text('nombre', null, array('placeholder' => 'nombre','class' => 'form-control'),['class' => 'form-control' , 'required' => 'required']) !!}
                        </div>
                    </div>
                    
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {!! Form::text('descripcion', null, array('placeholder' => 'descripcion','class' => 'form-control'),['class' => 'form-control' , 'required' => 'required']) !!}
                        </div>
                    </div>

                    

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Fecha Inicio:</strong>
                            <input type="date" name="fecha_inicio">
                        
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Fecha Fin:</strong>
                            <input type="date" name="fecha_fin">
                        
                        </div>
                    </div>

                    
                    
                </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

<div style="width : 80%; margin : 0 auto;">
{!! $items->render() !!}
</div>
@endsection