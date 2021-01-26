@extends('layouts.app')

@section('contentheader_title')
     Evaluaciones del estudiante {{ Auth::user()->name }}
@endsection 

@section('main-content') 

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered" style="width : 80%; margin : 0 auto;">
        <tr>
            <th>No</th>
            <th>Tutoría</th>
            <th>Fecha</th>
            <th>Puntuación</th>
            <th>Ver Prueba</th>
            

        </tr>
        <?php $i = '0'; ?>
    @foreach ($items as $key => $item)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $item->inEvaluacion->enTaller->titulo }}</td>
        <td>{{ $item->fecha }}</td>
        <td>{{ $item->puntuacion }}</td>
        <td>            <a class="btn btn-info" href="{{ URL('ver_prueba',$item->id) }}" >Ver prueba</a>
        </td>
           
    </tr>
    @endforeach
    </table>

    {{ $items->links() }}



@endsection