@extends('layouts.app')

@section('contentheader_title')
     menu
@endsection


@section('main-content')
    <table class="table table-bordered" style="width : 80%; margin : 0 auto; ">
        <tr>
            <th>Titulo</th>
        </tr>
    @foreach ($items as $key => $item)
    <tr>
        <td>{{ $item->titulo }}</td>
    </tr>
    @endforeach
    </table>
@endsection