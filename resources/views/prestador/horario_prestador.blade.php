
@extends('layouts/prestador-layout')


@section('subhead')

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
    <div id="asistencias" data-asistencias="{{json_encode($asistencias)}}"></div>


@endsection

<script src="{{asset('build/assets/js/calendar.global.min.js')}}"></script>

<script>
  
  document.addEventListener('DOMContentLoaded', function() {
    
    var asistencias = document.getElementById("asistencias").getAttribute('data-asistencias');
    var array = JSON.parse(asistencias);
    var a=[];
    
    //Asistencias
    array.forEach(function(elemento) {
          console.log(elemento.fecha);
          a.push({
          id: 'a',
          title: 'Asistencia',
          start: elemento.fecha,
          end: elemento.fecha,
          backgroundColor: "#00FFF0",
          display: "background"
        });
    });
    
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialDate: Date.now(),
      events: [
          ...a
        ],
    });
    calendar.render();
  });

</script>

