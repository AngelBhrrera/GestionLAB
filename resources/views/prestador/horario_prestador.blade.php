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
    <nav aria-label="breadcrumb" class="-intro-x hidden xl:flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('homeP')}}">Prestador</a></li>
            <li class="breadcrumb-item active" aria-current="page">Horario prestador</li>
        </ol>
    </nav>
@endsection


@section('subcontent')
    <div id='container'>
        <div id='calendar'  style='width: 800px; height: 1150px;'></div>
    </div>
@endsection

