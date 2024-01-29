@extends('layouts/prestador-layout')

@section('subhead')

    <script>

      document.addEventListener('DOMContentLoaded', function() {
          var calendarEl = document.getElementById('calendar');
          var calendar = new FullCalendar.Calendar(calendarEl, {
              initialView: 'dayGridMonth',
              initialDate: new Date()  // Establecer la fecha actual como la fecha inicial
          });
          calendar.render();
      });

    </script>


@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">Horario prestador</li>
@endsection


@section('subcontent')
    <div id='container'>
        <div id='calendar'  style='width: 800px; height: 1150px;'></div>
    </div>
@endsection

