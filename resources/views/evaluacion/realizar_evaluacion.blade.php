@extends('layouts.app')

@section('contentheader_title')
    Conocete tutoria: {{$titulo}}
@endsection 

@section('main-content')



    {!! Form::open(array('action' => 'EvaluacionController@guardarEvaluacion','method'=>'POST')) !!}

    {{ Form::hidden('id', $id) }}

    {{ Form::hidden('id_eval', $id_eval) }}

    {{--*/ $i = 0 /*--}}
<div style="margin-right: 5%; margin-left: 5%; margin-top: 5%;">
	@foreach ($aleatorio as $pregunta)
		
		@if($pregunta->rutaImagen)
		<div style="margin-top: 5%; margin-bottom: 2%; height:230px;" >
            <div>
                <strong>{{$i+1}}: {{$pregunta->enunciado}}</strong>
            </div>
            <div style="margin-left:20%;">
                <img src="../Recursos/{{$pregunta->rutaImagen}}" height="200" width="300">
            </div>
        @else
        <div style="margin-top: 5%; margin-bottom: 2%;" >
            <strong>{{$i+1}}:{{$pregunta->enunciado}}</strong>
        @endif  

	</div>

	<style>
		.row:nth-of-type(2n) {
		    background: #ccccff;
		}
		.row:nth-of-type(2n+1) {
		    background: #e6e6ff;
		}
	</style>
	<div >
		@foreach ($pregunta->respuestas as $respuesta)
		<div class="row" style="margin-left: 5%;    margin-right: 5%;">
			<div class="col-md-1" style="padding: 4%;">
				{{ Form::radio('pregunta['.$i.']', $array[$i].'nn'.$respuesta->id) }}
			</div>
			<div class="col-md-3">
                @if($respuesta->rutaIMagen)
                <img src="../Recursos/{{$respuesta->rutaIMagen}}" height="100" width="200">
                @else
                <img src="../Recursos/default_resp.jpg" height="100" width="200">
                @endif
                                     
            </div>
            <div class="col-md-8" style="height: 100px; display: table;">
				<div style="display: table-cell; vertical-align: middle;">{{$respuesta->respuesta}}   </div>
			</div>
		</div>
		
		@endforeach
	</div>
		{{--*/ $i++ /*--}}

	
	@endforeach

		<div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
	{!! Form::close() !!}
</div>
@endsection