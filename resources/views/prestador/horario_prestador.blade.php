
@extends('layouts/prestador-layout')


@section('subhead')
<style>
  .fc-event-title {
      color: white;
      font-style: normal;
      background: black;
      border-radius: 5px;
    }
</style>
  
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">Horario prestador</li>
@endsection


@section('subcontent')
    <div id='container'>
        <div id='calendar'  style='width: 800px; height: 1150px;'></div>
    </div>
    <div id="asistencias" data-asistencias="{{json_encode($asistencias)}}"></div>
    <div id="festivos" data-festivos="{{json_encode($festivos)}}"></div>


@endsection

<script src="{{asset('build/assets/js/calendar.global.min.js')}}"></script>

<script>
  
  document.addEventListener('DOMContentLoaded', function() {
    
    var asistencias = document.getElementById("asistencias").getAttribute('data-asistencias');
    var festivos = document.getElementById("festivos").getAttribute('data-festivos');
    var arrayAsist = JSON.parse(asistencias);
    var arrayFest = JSON.parse(festivos);
    var a=[];
    var fest=[];
    
    //Asistencias
    arrayAsist.forEach(function(elemento) {
          a.push({
          start: elemento.fecha,
          end: elemento.fecha,
          backgroundColor: "#00FFF0",

          display: "background"
        });
    });

    //Días festivos
    arrayFest.forEach(function(elemento) {
          fest.push({
          title: elemento.evento,
          start: elemento.inicio,
          end: elemento.final,
          backgroundColor: "#0056A6",
          display: "background"
        });
    });

    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialDate: Date.now(),
      events: [
          ...a,
          ...fest
        ],

    });


    var colorStyle = document.getElementsByClassName('fc-event-title');

      for (var i=0; i<colorStyle.length; i++) {
        colorStyle[i].style.fontStyle = 'normal';
    }
    calendar.render();
  });

  
</script>

