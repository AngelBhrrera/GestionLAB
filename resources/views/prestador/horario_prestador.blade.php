
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
    <nav aria-label="breadcrumb" class="-intro-x hidden xl:flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('homeP')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Horario prestador</li>
        </ol>
    </nav>
@endsection

@section('subcontent')
    <div class="text-center">
        
      <a href="javascript:;" data-theme="light" data-tooltip-content="#chart-tooltip"  class="tooltip btn btn-primary" title="This is awesome tooltip example!"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
      viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
      class="lucide lucide-help-circle"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
      <path d="M12 17h.01"/></svg></i>{{__(' Ayuda')}}</a>
    </div>
    <!-- END: Custom Tooltip Toggle -->
    <!-- BEGIN: Custom Tooltip Content -->
    <div class="tooltip-content">
        <div id="chart-tooltip" class="py-1">
            <div class="font-medium dark:text-slate-200">Código de colores</div>
                <div class="block w-8 h-8 cursor-pointer rounded-full " style="background: #ABC6E1"></div>Festivos/No laborables
                <br>
                <div class="block w-8 h-8 cursor-pointer bg-[#00195f] rounded-full" style="background: #ABF9F7"></div>
                Asistencias
                <br>
                <div class="block w-8 h-8 cursor-pointer bg-[#00195f] rounded-full" style="background: #F8ACAF"></div>
                Faltas
            </div>
        </div>
    </div>
    <div id='container'>
        <div id='calendar' style='width: auto; height: auto;'></div>
    </div>
    <div id="asistencias" data-asistencias="{{json_encode($asistencias)}}"></div>
    <div id="faltas" data-faltas="{{json_encode($fechasFaltas)}}"></div>
    <div id="festivos" data-festivos="{{json_encode($festivos)}}"></div>
    <div id="horario" data-horario="{{json_encode(Auth::user()->horario)}}"></div>
@endsection

@section('script')

  <script src="{{asset('build/assets/js/calendar.global.min.js')}}"></script>
  
  <script>

    const mesActual = new Date().getMonth(); 
    const añoActual = new Date().getFullYear(); 
    const fechaActual = new Date();
    
    document.addEventListener('DOMContentLoaded', function() {
      
      var asistencias = document.getElementById("asistencias").getAttribute('data-asistencias');
      var festivos = document.getElementById("festivos").getAttribute('data-festivos');
      var fechasFaltas = document.getElementById("faltas").getAttribute('data-faltas');
      var horario = JSON.parse(document.getElementById('horario').getAttribute('data-horario'));
      var arrayAsist = JSON.parse(asistencias);
      var arrayFest = JSON.parse(festivos);
      var arrayFalt = JSON.parse(fechasFaltas);
      var a=[];
      var fest=[];
      var faltas = [];
      var faltasCalendario=[];
      //Asistencias
      arrayAsist.forEach(function(elemento) {
            a.push({
            start: elemento,
            end: elemento,
            backgroundColor: "#00FFF0",
            display: "background"
          });
      });

      //Días festivos
      arrayFest.forEach(function(elemento) 
      {
            if(elemento.tipo == "vacaciones"){
              var fecha = new Date(elemento.final);

              fecha.setDate(fecha.getDate() + 2);

              elemento.final = fecha.getFullYear() + '-' + ('0' + (fecha.getMonth() + 1)).slice(-2) + '-' + ('0' + fecha.getDate()).slice(-2);
            }
            fest.push({
            title: elemento.evento,
            start: elemento.inicio,
            end: elemento.final,
            backgroundColor: "#0056A6",
            display: "background"
          });
      });

      //Faltas

      arrayFalt.forEach(function(elemento) {
            faltas.push({
            start: elemento,
            end: elemento,
            backgroundColor: "red",
            display: "background"
          });
      })

      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
            buttonText: {
          today: 'Hoy'
        },
        eventOverlap: false,
        locale: 'es',
        initialDate: Date.now(),
        events: [
            ...a,
            ...fest,
            ...faltas
          ],

      });

      var colorStyle = document.getElementsByClassName('fc-event-title');

      for (var i=0; i<colorStyle.length; i++) {
        colorStyle[i].style.fontStyle = 'normal';
      }
      calendar.render();
      
      var margin = 0;
      const eventos = document.querySelectorAll(".fc-event-title");
      eventos.forEach(function(evento) {
        evento.style.marginTop= margin;
        margin+=20;
      });
    });
    
  </script>

@endsection

