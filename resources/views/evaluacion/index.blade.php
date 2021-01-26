@extends('layouts.app')

@section('contentheader_title')
     Mantenimiento de Evaluaciones
@endsection 

@section('main-content')

    <div class="row" style="margin-right:15%;">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" data-toggle="modal" data-target="#nEval">
                  <span class="glyphicon glyphicon-plus"></span> Crear nueva evaluación
                 </a>
            </div>
        </div>
    </div>
     @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <!-- Modal Nueva evaluacion-->
<div>
<div class="modal fade" id="nEval" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Nueva Evaluación</h4>
        </div>
        <div class="modal-body">

            {!! Form::open(array('route' => 'evaluacion.store','method'=>'POST')) !!}
                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {!! Form::text('nombre', null, array('placeholder' => 'nombre','class' => 'form-control')) !!}
                        </div>
                    </div>
                    
                    {{ Form::hidden('fecha', null) }}

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Duración:</strong>
                            {!! Form::text('tiempo', null, array('placeholder' => 'Duracion','class' => 'form-control')) !!}
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Tutoría:</strong>
                            {!! Form::select('taller_id', $talleres, null) !!}
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

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered" style="width : 80%; margin : 0 auto;">
        <tr>
            <th>No</th>
            <th>Nombre</th>
            <th>Fecha de Creación</th>
            <th>Duración</th>
            <th>Tutoría</th>
            

            <th width="280px">Acciones</th>
        </tr>
    @foreach ($items as $key => $item)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $item->nombre }}</td>
        <td>{{ $item->fecha }}</td>
        <td>{{ $item->tiempo }}</td>
        <td>{{ $item->entaller->titulo }}</td>
           <td>
            <a class="btn btn-info" href="{{ URL('index2',$item->id) }}">
              <span class="glyphicon glyphicon-list-alt"></span>
            </a>
            {{--<a class="btn btn-info" href="{{ route('evaluacion.edit',$item->id) }}">Editar</a>--}}
            <a class="btn btn-info" data-toggle="modal" data-target="#editeval{{ $item->id }}"> 
                <span class="glyphicon glyphicon-pencil"></span>
            </a>
            <a class="btn btn-danger" data-toggle="modal" data-target="#eeval{{ $item->id }}"> 
                <span class="glyphicon glyphicon-remove"></span>
            </a>

                        
            <!-- Modal editar -->
            <div> 
                        <div class="modal fade" id="editeval{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Editar Evaluación</h4>
                                </div>

                                <div class="modal-body">
                                    {!! Form::model($item, ['method' => 'PATCH','route' => ['evaluacion.update', $item->id]]) !!}
                                    <div class="row">

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Nombre:</strong>
                                                {!! Form::text('nombre', null, array('placeholder' => 'nombre','class' => 'form-control')) !!}
                                            </div>
                                        </div>
                                        

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Duracion:</strong>
                                                {!! Form::text('tiempo', null, array('placeholder' => 'Duracion','class' => 'form-control')) !!}
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Taller:</strong>
                                                {!! Form::select('taller_id', $talleres, null) !!}
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
                <div class="modal fade" id="eeval{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Confirmar eliminación</h4>
                        </div>
                        
                      <div class="modal-footer">
                         {!! Form::open(['method' => 'DELETE','route' => ['evaluacion.destroy', $item->id],'style'=>'display:inline']) !!}
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
    <div style="margin-left:10%;">
    {!! $items->render() !!}
    </div>
@endsection