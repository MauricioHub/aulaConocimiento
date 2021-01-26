@extends('layouts.default')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Crear Nuevo Taller</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('taller.index') }}"> Atras</a>
            </div>
        </div>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::open(array('route' => 'taller.store','method'=>'POST')) !!}
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Titulo:</strong>
                {!! Form::text('titulo', null, array('placeholder' => 'Titulo','class' => 'form-control')) !!}
            </div>
        </div>
        
       <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Duracion:</strong>
                {!! Form::text('duracion', null, array('placeholder' => 'duracion','class' => 'form-control')) !!}
            </div>
        </div>


        

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </div>
    {!! Form::close() !!}

@endsection