@extends('layouts.app')

@section('contentheader_title')
    Tutorías
@endsection


@section('main-content')

    

    @if ($message = Session::get('success'))
        <div class="alert alert-success" >
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered" style="width : 80%; margin : 0 auto; ">
        <tr>
            <th>No</th>
            <th>Título</th>
                  
            <th width="280px"></th>
        </tr>
    @foreach ($items as $key => $item)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $item->titulo }}</td>
        
        <td>
            <a class="btn btn-info" href="{{ URL('realizar',$item->id) }}">
                <span class="glyphicon glyphicon-arrow-right"></span>
            </a>

        </td>
    </tr>
    @endforeach
    </table>

    <div style="width : 80%; margin : 0 auto;">
    {!! $items->render() !!}
    </div>


@endsection