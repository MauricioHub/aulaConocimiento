@extends('layouts.default')

@section('content')


    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Nueva Pregunta</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('pregunta.index') }}"> Back</a>
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

    {!! Form::open(array('route' => 'pregunta.store','method'=>'POST')) !!}
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Enunciado:</strong>
                {!! Form::text('enunciado', null, array('placeholder' => 'Enunciado','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Ruta_Imagen:</strong>
                {!! Form::number('rutaImagen', null, array('placeholder' => 'ruta','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Evaluacion_id:</strong>
                {!! Form::number('evaluacion_id', null, array('placeholder' => 'evaluacion','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tipo_pregunta:</strong>
                {!! Form::number('tipopregunta', null, array('placeholder' => 'tipo','class' => 'form-control')) !!}
            </div>
        </div>


        

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </div>
    {!! Form::close() !!}

@endsection