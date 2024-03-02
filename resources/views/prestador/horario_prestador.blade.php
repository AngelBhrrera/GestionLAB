
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
            <li class="breadcrumb-item"><a href="{{route('homeP')}}">Prestador</a></li>
            <li class="breadcrumb-item active" aria-current="page">Horario prestador</li>
        </ol>
    </nav>
@endsection

@section('subcontent')

    <div id='container'>
        <div id='calendar' style='width: 100%; height: 100%;'></div>
    </div>
    <div id="asistencias" data-asistencias="{{json_encode($asistencias)}}"></div>
    <div id="faltas" data-faltas="{{json_encode($fechasFaltas)}}"></div>
    <div id="festivos" data-festivos="{{json_encode($festivos)}}"></div>
    <div id="primerCheck" data-check="{{json_encode($primerCheck)}}"></div>
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
      var primerCheck = convertirFormatoFecha(JSON.parse(document.getElementById("primerCheck").getAttribute('data-check')).fecha);
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

      function obtenerDiasLaborablesDelMes(mes, año) {
          const diasLaborables = [];
          const primerDiaMes = new Date(año, mes, 1);
          const ultimoDiaMes = new Date(año, mes + 1, 0);

        for (let dia = 1; dia <= ultimoDiaMes.getDate(); dia++) {
            const fecha = new Date(año, mes, dia);
            const diaSemana = fecha.getDay();

            if (diaSemana >= 1 && diaSemana <= 5) { // Si es de lunes a viernes
                diasLaborables.push(fecha.toISOString().slice(0,10)); // Formato YYYY-MM-DD
            }
        }
        return diasLaborables;
      }

      function contarFaltas() {
        var asistencias = document.getElementById("asistencias").getAttribute('data-asistencias');
        var festivos = document.getElementById("festivos").getAttribute('data-festivos');
        var arrayAsist = JSON.parse(asistencias);
        var arrayFest = JSON.parse(festivos);

        const diasLaborables = obtenerDiasLaborablesDelMes(mesActual, añoActual);
        const diasLaborablesNoFestivos = diasLaborables.filter(dia => !arrayFest.includes(dia) && new Date(dia) <= fechaActual);
        let faltas = 0;
        diasLaborablesNoFestivos.forEach(diaLaborable => {
          const asistenciaEnDia = arrayAsist.find(asistencia => asistencia === diaLaborable);
          if (!asistenciaEnDia && (diaLaborable > primerCheck)) {
            console.log(diaLaborable);
            faltas++;
            faltasCalendario.push({
              start: diaLaborable,
              end: diaLaborable,
              backgroundColor: "red",
              display: "background"
            });
          }
        });
        return faltas;
      }

      function convertirFormatoFecha(fecha) {
          // Dividir la cadena de fecha en día, mes y año
          var partes = fecha.split("/");
          var day = partes[0];
          var month = partes[1];
          var year = partes[2];

          // Crear una nueva cadena de fecha en el formato "aaaa-mm-dd"
          var nuevaFecha = year + "-" + month + "-" + day;

          return nuevaFecha;
      }

      //faltas = contarFaltas();
      //console.log(faltas);
      //console.log(faltasCalendario);

      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        eventOverlap: false,
        initialDate: Date.now(),
        events: [
            ...a,
            ...fest,
            ...faltas
            //...faltasCalendario
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

