@extends('layouts.app')

@section('content')

<div class="container">
  <h1 class="text-center">Titulo: {{ $actividad->nombre_act }}</h1>

  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Detalle de Actividad</div>
        <div class="card-body">
          <p><strong>Actividad creada por:</strong> {{ $user->name }}  {{$user->apellido}}</p>
          <p><strong>Descripción:</strong> {{ $actividad->descripcion }}</p>
          <p><strong>Objetivo:</strong> {{ $actividad->objetivo }}</p>
          <p><strong>Fecha:</strong> {{ $actividad->fecha }}</p>
          <p><strong>Estado:</strong> {{ $actividad->status }}</p>
          <p><strong>Estimación Tiempo:</strong> {{ $actividad->estimacion_tiempo }}</p>

          <a href="{{ url()->previous() }}" class="btn btn-primary">Volver</a>

        </div>
      </div>
    </div>
  </div>

</div>

@endsection

<script src={{ asset('plugins/jquery/jquery.min.js') }}></script>
<script src={{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}></script>
<!-- AdminLTE App -->
<script src={{ asset('dist/js/adminlte.min.js') }}></script>
<!-- AdminLTE App -->
<script src={{ asset('plugins/datatables/jquery.dataTables.min.js') }}></script>
<script src={{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}></script>
<script src={{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}></script>
<script src={{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}></script>
<script src={{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}></script>
<script src={{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}></script>
<script src={{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}></script>
<script src={{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}></script>
<script src={{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}></script>

