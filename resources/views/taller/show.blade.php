@extends('layouts.app')

@section('contentheader_title')
     Actividades
@endsection


@section('main-content')

    <div class="row" style="width : 80%; margin : 0 auto;">
        <div class="col-lg-12 margin-tb">
            
            <div class="pull-right">
                <a class="btn btn-success" data-toggle="modal" data-target="#nactividad">
                <span class="glyphicon glyphicon-plus"> Crear Actividad</span> 
                </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="row" style="width : 80%; margin : 0 auto;">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Título:</strong>
                {{ $item->titulo }}
            </div>
        </div>

       
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Duración:</strong>
                {{ $item->duracion }}
            </div>
        </div>

        <div class="table-resposive" style="float:left"; >
        <table class="table-bordered table-striped">
            <tr>
                <th>Actividad</th>
                <th>Descripción</th>
                <th>Nombre de archivo</th>
                <th>Tipo archivo</th>
                <th>Acciones</th>
            </tr>
            
            @foreach ($item->recursos as $recurso)
            <tr>
                <th>{{ $recurso->orden }}</th>
                <td>{{ $recurso->descripcion }}</td>
                <td>{{ $recurso->nombre_archivo }}</td>
                <td>{{ $recurso->extension }}</td>
                <td NOWRAP>
                    {{--<a class="btn btn-primary" href={{ route('recurso.edit',$recurso->id) }}>Edit</a>--}}

                    <a class="btn btn-primary" data-toggle="modal" data-target="#editactv{{ $recurso->id }}"> <span class="glyphicon glyphicon-pencil"></span></a>
                    <a class="btn btn-danger" data-toggle="modal" data-target="#eactv{{ $recurso->id }}"> <span class="glyphicon glyphicon-remove"></span></a>
                    <div>    
                        <!-- Modal editar actividad-->
                        <div class="modal fade" id="editactv{{ $recurso->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Editar Actividad</h4>
                                </div>

                                <div class="modal-body">
                                    {!! Form::model($recurso, ['method' => 'PATCH','route' => ['recurso.update', $recurso->id],'files'=>true]) !!}
                                    <div class="row">

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                          <div class="form-group">
                                                <strong>Numero de actividad:</strong>
                                                {!! Form::number('orden', null, array('placeholder' => '#','class' => 'form-control')) !!}
                                          </div>    
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Descripcion:</strong>
                                                {!! Form::text('descripcion', null, array('placeholder' => 'Nueva descripcion','class' => 'form-control')) !!}
                                            </div>
                                        </div>
                                        
                                        <div class="col-xs-12 col-sm-12 col-md-12"> 
                                          <div class="form-group">      
                                            <strong>Archivo:{{$recurso->archivo}}</strong>
                                          </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12"> 
                                          <div class="form-group">    
                                            <label class="col-md-4 control-label">Editar Archivo</label>
                                                
                                          </div>
                                        </div>        
                                        
                                        <div class="col-xs-12 col-sm-12 col-md-12"> 
                                          <div class="form-group"> 
                                            <input type="file" class="form-control" name="file" > 
                                          </div>
                                        </div> 
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                          <div class="form-group"> 
                                            <p>Archivos soportados: .mp4, .pdf, .jpg, .png, .gif</p>
                                          </div>
                                        </div>     
                                    </div>
                                </div>
                                
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                                 {!! Form::submit('Editar', ['class' => 'btn btn-success']) !!}
                                {!! Form::close() !!}
                              </div>
                              
                            </div>
                          </div>
                        </div>

                      </div>



                    

                        



                </td>
            </tr>

            
            <!-- Modal eliminar -->
            <div>
                        <div class="modal fade" id="eactv{{ $recurso->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Confirmar eliminación</h4>
                                </div>
                                
                              <div class="modal-footer">
                                 {!! Form::open(['method' => 'DELETE','route' => ['recurso.destroy', $recurso->id],'style'=>'display:inline']) !!}
                                 <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                                 {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                              </div>
                              
                            </div>
                          </div>
                        </div>   
            </div>    
            @endforeach
        </table>

</div>

<script src="https://code.jquery.com/jquery-3.1.1.js" ></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<!-- Modal nueva actividad-->
<div>
  <div class="modal fade" id="nactividad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Nueva Actividad</h4>
        </div>
        <div class="modal-body">
          
              {!! Form::open(array('route' => 'recurso.store','method'=>'POST','files' => true)) !!}
              {{ Form::hidden('taller_id', $item->id) }}
              {{ Form::hidden('archivo', '') }}
              {{ Form::hidden('nombre_archivo', '') }}
              {{ Form::hidden('extension','' ) }}


              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                  <strong>Numero de actividad:</strong>
                  {!! Form::number('orden', null, array('placeholder' => '#','class' => 'form-control')) !!}
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                  <strong>Descripción de la actividad:</strong>
                  {!! Form::text('descripcion', null, array('placeholder' => 'Nueva descripcion','class' => 'form-control')) !!}
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                  <strong>Subir archivo:</strong>
                  <input type="file" class="form-control" name="file" >
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group"> 
                  <p>Archivos soportados: .mp4, .pdf, .jpg, .png, .gif</p>
                  <p>Peso maximo: 3Mb</p>
                </div>
              </div> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
          {!! Form::close() !!}
        </div>
        
      </div>
    </div>
  </div>
</div>

           
            

         

@endsection