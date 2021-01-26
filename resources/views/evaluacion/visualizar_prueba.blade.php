@extends('layouts.app')

@section('contentheader_title')
     Resultados de la evaluación de la tutoría:{{$titulo}}
@endsection 

@section('main-content')

    

    

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    {{--*/ $i = 0 /*--}}
    <div style="float: right; margin-right: 20%; color: red; font-size: 200%;">
        <strong>Su puntuación es: {{$calificacion}}</strong>
    </div>
    <div style="margin-right: 5%; margin-left: 5%; margin-top: 5%;">
    @foreach($items as $detalle)
        <div style="margin-top: 5%; margin-bottom: 2%;">
          
                @if($detalle->inPregunta->rutaImagen)
                    <div>
                        <strong>{{++$i}}: {{$detalle->inPregunta->enunciado}}</strong>
                    </div>
                    <div style="margin-left:20%;">
                        <img src="../Recursos/{{$detalle->inPregunta->rutaImagen}}" height="200" width="300">
                    </div>
                @else
                    <strong>{{++$i}}: {{$detalle->inPregunta->enunciado}}</strong>
                @endif   
            
        </div>
       
            
            @foreach($detalle->inPregunta->respuestas as $resp)
             <div class="row" style="margin-left: 5%;    margin-right: 5%;">
                <div class="col-md-3">
                    @if($resp->rutaIMagen)
                    <img src="../Recursos/{{$resp->rutaIMagen}}" height="100" width="200">
                    @else
                    <img src="../Recursos/default_resp.jpg" height="100" width="200">
                    @endif
                                         
                </div>
                <div class="col-md-8" style="height: 100px; display: table;">

                    @if(($resp->es_correcta)&& ($resp->id == $detalle->respuesta_seleccionada_id))
                    <div style="background:#00ff00; display: table-cell; vertical-align: middle;">
                    @elseif($resp->id == $detalle->respuesta_seleccionada_id)
                    <div style="background:#ff3300; display: table-cell; vertical-align: middle; color: white;">
                    @else
                    <div style="display: table-cell; vertical-align: middle; ">
                    @endif
                        <p>{{$resp->respuesta}}</p>
                    </div>
                </div>
            </div>   
            @endforeach
            
             
    @endforeach
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <a class="btn btn-info" href="{{ URL('resumen') }}">Ver mis evaluaciones  </a>
    </div>


@endsection