@extends('layouts/prestador-layout')
    
@section('subhead')

    <style>
    #container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh; /* Altura total de la ventana */
    }

    #calendar {
        width: 300px;
        height: 300px;
    }
    </style>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth'
        });
        calendar.render();
      });

    </script>

@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb" class="-intro-x hidden xl:flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('homeP')}}">Prestador</a></li>
            <li class="breadcrumb-item active" aria-current="page">Registro de asistencias</li>
        </ol>
    </nav>
@endsection

@section('subcontent')

<body>
    <div id='container'>
        <div id='calendar'  style='width: 300px; height: 300px; margin: 0 auto;'></div>
    </div>
</body>

@endsection