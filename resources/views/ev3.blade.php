@extends('layouts.app')

@section('contentheader_title')
	
@endsection


@section('main-content')
	<div class="container spark-screen">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<?php $total=count($nombre);$i=0?>
					@foreach ($nombre as $ev3)
						<?php $i=$i+1?>
						@if($i==$total)	
							<embed src="/aulaConocimiento/public/Recursos/{{$ev3->ruta}}" type="application/pdf" width="800" height="700"></embed>	
						@endif	
    				@endforeach
				</div>
			</div>
		</div>
	</div>
@endsection
