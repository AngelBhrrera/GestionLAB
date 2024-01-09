@extends('layouts/prestador-layout')
@section('content')

<head>
  
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<div class="container">
    <h1 class="text-center">Actividades Terminadas</h1>


    <table id="tablaprestadores" class="table table-bordered table-hover display" style="overflow-x:auto;">
        <thead>
        <tr>
            @foreach ($datos as $dato )
            <th>{{$dato}}</th>

            @endforeach

        </tr>
        </thead>

      </table>

</div>
@endsection


