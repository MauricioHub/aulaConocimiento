@extends('layouts.app')

@section('contentheader_title')
     Mantenimiento de Tutorías
@endsection

@section('main-content')

    <div class="row" style="width : 80%; margin : 0 auto;">
        </br><div class="col-lg-12 margin-tb">
            
            <div class="pull-right">
                <a class="btn btn-success" data-toggle="modal" data-target="#myModal">
                  <span class="glyphicon glyphicon-plus"></span> Crear tutoría
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
            <th>Título</th>
            <th>Duración</th>
            
            <th width="280px">Acciones</th>
        </tr>
    @foreach ($items as $key => $item)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $item->titulo }}</td>
        <td>{{ $item->duracion }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('taller.show',$item->id) }}">
              <span class="glyphicon glyphicon-list-alt"></span>
            </a>
            {{--<a class="btn btn-info" href="{{ route('taller.edit',$item->id) }}">Editar</a>--}}
            <a class="btn btn-info" data-toggle="modal" data-target="#edittaller{{ $item->id }}"> 
                <span class="glyphicon glyphicon-pencil"></span>
            </a>
            <a class="btn btn-danger" data-toggle="modal" data-target="#etaller{{ $item->id }}"> 
                <span class="glyphicon glyphicon-remove"></span>
            </a>        
            <!-- Modal editar -->
            <div> 
                        <div class="modal fade" id="edittaller{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Editar Tutoria</h4>
                                </div>

                                <div class="modal-body">
                                    {!! Form::model($item, ['method' => 'PATCH','route' => ['taller.update', $item->id]]) !!}
                                    <div class="row">

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Titulo:</strong>
                                                {!! Form::text('titulo', null, array('placeholder' => 'Titulo','class' => 'form-control'),['class' => 'form-control' , 'required' => 'required']) !!}
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Duracion:</strong>
                                                {!! Form::number('duracion', null, array('placeholder' => 'Duracion','class' => 'form-control')) !!}
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
                <div class="modal fade" id="etaller{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Confirmar eliminación</h4>
                        </div>
                        
                      <div class="modal-footer">
                         {!! Form::open(['method' => 'DELETE','route' => ['taller.destroy', $item->id],'style'=>'display:inline']) !!}
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


<!-- Modal Nuevo taller-->
<div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Nuevo Taller</h4>
        </div>
        <div class="modal-body">

            {!! Form::open(array('route' => 'taller.store','method'=>'POST')) !!}
                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Titulo:</strong>
                            {!! Form::text('titulo', null, array('placeholder' => 'Titulo','class' => 'form-control'),['class' => 'form-control' , 'required' => 'required']) !!}
                        </div>
                    </div>
                    
                   <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Duracion:</strong>
                            {!! Form::number('duracion', null, array('placeholder' => 'Duracion','class' => 'form-control')) !!}
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