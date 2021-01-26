@extends('layouts.app')

@section('contentheader_title')
AVANCE DEL CONOCIMIENTO
@endsection


@section('main-content')
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
	          @foreach($pastel as $pastels)
	          	['{{$pastels->name}}',{{$pastels->value}}],
	          @endforeach
        ]);

        var options = {
          title: 'Ultimo reto completado: {{$tutoria}}',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

    <div id="piechart" style="width: 900px; height: 500px;"></div>
@endsection


