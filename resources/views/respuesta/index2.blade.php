@extends('layouts.app')

@section('contentheader_title')
     MANTENIMIENTO DE RESPUESTAS
@endsection

@section('main-content')

    <div class="row" style="width : 80%; margin : 0 auto;">
        <div class="col-lg-12 margin-tb">
            
            <div class="pull-right">
                <a class="btn btn-success" data-toggle="modal" data-target="#myModal">
                  <span class="glyphicon glyphicon-plus"></span> Crear respuesta
                 </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div style="width : 80%; margin : 2% auto;">
      <strong>Pregunta:</strong> {{$titulo}}</br>
    </div>

    <table class="table table-bordered" style="width : 80%; margin : 0 auto;">
        <tr>
            <th></th>
            <th>Respuesta</th>
            <th>Validez</th>
            <th>Imagen</th>
            

            <th width="280px">Acciones</th>
        </tr>
    @foreach ($items as $key => $item)
    <tr>
        <td>{{++$i}}</td>
        <td>{{ $item->respuesta }}</td>
        <td>@if($item->es_correcta)
                <p>Verdadero</p>
            @else
                <p>Falso</p>
            @endif

            </td>
        
        <td>{{ $item->rutaImagen }}</td>
        <td>
                        
            <a class="btn btn-info" data-toggle="modal" data-target="#editrespuesta{{ $item->id }}"> 
                <span class="glyphicon glyphicon-pencil"></span>
            </a>
            <a class="btn btn-danger" data-toggle="modal" data-target="#erespuesta{{ $item->id }}"> 
                <span class="glyphicon glyphicon-remove"></span>
            </a>

                        
            <!-- Modal editar -->
            <div> 
                        <div class="modal fade" id="editrespuesta{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Editar Pregunta</h4>
                                </div>

                                <div class="modal-body">
                                    {!! Form::model($item, ['method' => 'PATCH','route' => ['respuesta.update', $item->id],'files'=>true]) !!}
                                    <div class="row">

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Respuesta:</strong>
                                                {!! Form::text('respuesta', null, array('placeholder' => 'respuesta','class' => 'form-control','files'=>true)) !!}
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <strong>Validez:</strong>
                                            {!! Form::select('es_correcta', ['' => 'Falso','1' => 'Verdadero'])  !!}

                                        </div>

                                        {{ Form::hidden('pregunta_id', $id) }}

                                         <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                              <strong>Subir imagen:</strong>
                                              <input type="file" class="form-control" name="file" >
                                            </div>
                                          </div>
                                          <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group"> 
                                              <p>Archivos soportados: .jpg, .png, .gif</p>
                                              <p>Peso maximo: 3Mb</p>
                                            </div>
                                          </div> 


                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Imagen:</strong>
                                                {!! Form::text('rutaImagen', null, array('placeholder' => 'ruta','class' => 'form-control','readonly')) !!}
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
                <div class="modal fade" id="erespuesta{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Confirmar eliminación</h4>
                        </div>
                        
                      <div class="modal-footer">
                         {!! Form::open(['method' => 'DELETE','route' => ['respuesta.destroy', $item->id],'style'=>'display:inline']) !!}
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


<script src="https://code.jquery.com/jquery-3.1.1.js" ></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

            <!-- Modal nuevo -->


<div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Nueva Respuesta</h4>
        </div>
        <div class="modal-body">

            {!! Form::open(array('route' => 'respuesta.store','method'=>'POST','files'=>true)) !!}
                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Respuesta:</strong>
                            {!! Form::text('respuesta', null, array('placeholder' => 'respuesta','class' => 'form-control')) !!}
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Validez:</strong>
                            {!! Form::select('es_correcta', ['' => 'Falso','1' => 'Verdadero'])  !!}

                        </div>
                    </div>

                    {{ Form::hidden('pregunta_id', $id) }}
                    {{ Form::hidden('rutaImagen', '') }}


                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                          <strong>Subir imagen:</strong>
                          <input type="file" class="form-control" name="file" >
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group"> 
                          <p>Archivos soportados: .jpg, .png, .gif</p>
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