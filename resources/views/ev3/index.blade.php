@extends('layouts.app')

@section('contentheader_title')
    Mantenimiento de Introduccion EV3
@endsection


@section('main-content')
    
    <div class="row" style="width : 80%; margin : 0 auto;">
        </br><div class="col-lg-12 margin-tb">
            
            <div class="pull-right">
                <a class="btn btn-success" data-toggle="modal" data-target="#myModal">
                  <span class="glyphicon glyphicon-plus"></span> Crear Ev3
                 </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('mensajeRetroAlimentacion'))
        <div class="alert alert-success alert-dismissible" runat ="server" id="modalEditError" visible ="false">
            <button class="close" type="button" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong> <div id="Div2" runat="server" ></div>
        </div>

    @endif

    @if($errors->has())
        <div class="alert alert-warning" role="alert">
           @foreach ($errors->all() as $error)
              <div>{{ $error }}</div>
          @endforeach
        </div>
    @endif </br>

    <table class="table table-bordered" style="width : 80%; margin : 0 auto; ">
        <tr>
            <th width="100px">Titulo</th>
            <th width="280px">Descrip.</th>      
            <th width="200px">Acciones</th>
        </tr>
    @foreach ($items as $key => $item)
    @if($item->activo==1)
    <div>
        
        <tr>
            <td>{{ $item->titulo }}</td>
            <td>{{ $item->descripcion }}</td>
            <td>
                <a class="btn btn-info" href="{{ url('ev3',$item->titulo) }}">
                  <span class="glyphicon glyphicon-list-alt"></span>
                </a>
                <a class="btn btn-info" data-toggle="modal" data-target="#myModalEditarEv3{{ $item->id }}"> 
                    <span class="glyphicon glyphicon-pencil"></span>
                </a>
                <a class="btn btn-danger" data-toggle="modal" data-target="#eliminarev3{{$item->id}}"> 
                    <span class="glyphicon glyphicon-remove"></span>
                    
                </a>

            </td>
        </tr>
        
    </div>
    @endif
    <div class="modal fade"  id="eliminarev3{{$item->id}}" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background-color:#e7e7e7">
            <h4 class="modal-title" style="color:black">Mensaje de Confirmación</h4>
          </div>
          <div class="modal-body">
            <p>¿Está seguro(a) que desea eliminar esta información?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <a class="btn btn-info" href="{{ url('ev3/eliminar',$item->id)}}">Aceptar</a>
          </div>
        </div><!-- /.modal-content   -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Modal editar -->
    <div> 
        <div class="modal fade" id="myModalEditarEv3{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Editar EV3</h4>
                </div>
                <div class="modal-body">
                    {!! Form::model($item, array('route' => ['ev3.update',$item->id],'method'=>'PATCH', 'files'=>true, 'enctype'=>'multipart/form-data')) !!}
                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                {!! Form::text('titulo',null, array('placeholder' => 'Titulo','class' => 'form-control'),['class' => 'form-control' , 'required' => 'required']) !!}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                {!! Form::text('descripcion', null, array('placeholder' => 'Descripcion','class' => 'form-control'),['class' => 'form-control' , 'required' => 'required']) !!}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                Archivo Actual : {!! Form::text('ruta', null, array('placeholder' => 'Archivo','class' => 'form-control', 'disabled')) !!}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12"> 
                            <div class="form-group"> 
                                <strong>Fuente:</strong> 
                                {!! Form::file('file') !!}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group"> 
                                <p>Archivos soportados: .pdf, .jpg, .png</p>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div height="200px" class="form-group">
                                <strong>Seleccione Grupo de Contenido:</strong>
                                {!! Form::select('id_padre', $id_padre) !!}
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
    @endforeach
    </table>



<!-- Modal Nuevo ev3-->
<div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Nuevo Ev3</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(array('route' => 'ev3.store','method'=>'POST', 'files'=>true, 'enctype'=>'multipart/form-data')) !!}
                        <div class="row">

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    {!! Form::text('titulo', '', array('placeholder' => 'Titulo','class' => 'form-control'),['class' => 'form-control' , 'required' => 'required']) !!}
                                </div>
                            </div>
                    
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    {!! Form::text('descripcion', '', array('placeholder' => 'Descripcion','class' => 'form-control'), ['class' => 'form-control' , 'required' => 'required']) !!}
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12"> 
                                <div class="form-group"> 
                                    <strong>Fuente:</strong> 
                                    {!! Form::file('file',['class' => 'form-control' , 'required' => 'required']) !!}
                                </div>
                            </div> 

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group"> 
                                    <p>Archivos soportados: .pdf, .jpg, .png</p>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div height="200px" class="form-group">
                                    <strong>Seleccione Grupo de Contenido:</strong>
                                    {!! Form::select('id_padre', $id_padre) !!}
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
    </div>
</div>
@endsection