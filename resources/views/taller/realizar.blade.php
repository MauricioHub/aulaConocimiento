@extends('layouts.app')

@section('contentheader_title')
     Tutoría: {{ $item->titulo }}
@endsection


@section('main-content')

   


    <!-- Slide-->

    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false" style="margin: 5%;">
      <div class="carousel-inner" role="listbox">
        <?php $i = '1'; ?>
        @foreach ($item->recursos as $recurso)
        @if($i<2)
        <div class="item active">
        @else
        <div class="item">
        @endif  
          <div style="margin-left: 20%; margin-right: 20%;  margin-top: 3%;">
            <strong>Actividad {{$i++}}: </strong>
            {{ $recurso->descripcion }}<br/>  
          </div>
          <div style="margin-left: 15%; ">
            @if($recurso->extension===".mp4")
              <video width="80%" height="70%" onclick="this.play();"controls><source src="/aulaConocimiento/public/Recursos/{{ $recurso->nombre_archivo }}.mp4" type="video/mp4" ></video>
            @endif
            @if($recurso->extension===".pdf")
              <embed src="/aulaConocimiento/public/Recursos/{{ $recurso->nombre_archivo }}.pdf" type="application/pdf" width="80%" height="700px"></embed>          @endif
            @if($recurso->extension===".jpg" || $recurso->extension===".png" || $recurso->extension===".gif" || $recurso->extension===".jpeg" || $recurso->extension===".bmp")
              <img src="/aulaConocimiento/public/Recursos/{{ $recurso->archivo }}" alt="{{ $recurso->archivo }}" height="80%" width="70%">        
            @endif
          </div>
        </div>
        @endforeach
      </div>


      
      <!-- Left and right controls -->
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>


<div style="margin-left: 40%;">
  @if($item->evaluaciones)
    <a class="btn btn-info" href="{{ URL('realizar_evaluacion',$item->id) }}">Realizar evaluacion  </a>
  @endif
</div>

@endsection