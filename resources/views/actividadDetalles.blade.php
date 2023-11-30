@extends('layouts/app')

@section('content')

<div class="container">
  @if (session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif
  <h1 class="text-center">Titulo: {{ $actividad->nombre_act }}</h1>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Detalle de Actividad</div>
        <div class="card-body">
          <p><strong>Actividad creada por:</strong> {{ $actividad->creada_por }}</p>
          <p><strong>Asignado a prestador:</strong> {{ $actividad->asignado_a }}</p>
          <p><strong>Categoria:</strong> {{ $actividad->nombre_categoria }}</p>
          <p><strong>Actividad:</strong> {{ $actividad->nombre_actividad }}</p>
          <p><strong>Descripción:</strong> {{ $actividad->descripcion }}</p>
          <p><strong>Objetivo:</strong> {{ $actividad->objetivo }}</p>
          <p><strong>Fecha:</strong> {{ $actividad->fecha }}</p>
          <p><strong>Estado:</strong> {{ $actividad->status }}</p>
          <p><strong>Estimación Tiempo (prestador):</strong> {{ $actividad->estimacion_tiempo }}</p>
          <p><strong>Estimación Tiempo (actividad):</strong> {{ $actividad->horas_actividad }}</p>
          <p><strong>Duración:</strong> {{ $actividad->duracion }}</p>
          <p><strong>Experiencia obtenida:</strong> {{ $experiencia }}</p>

          {{-- <a href="#" onclick="window.close();" class="btn btn-danger">Cerrar</a> --}}
          <a href="{{ route('admin.actividadRevisada', ['id' => $actividad->id_actividad, 'experiencia' => $experiencia]) }}" class="btn btn-primary finalizar-btn">Finalizar</a>

        </div>
      </div>
    </div>
  </div>
</div>

@push('styles')
<style>
.finalizar-btn {
  display: block;
  margin: 0 auto;
  font-size: 1.2rem;
  padding: 10px 20px;
}

.finalizar-btn:hover {
  background-color: #4d94ff;
  transition: background-color 0.2s ease-out;
}

.finalizar-btn:active {
  transform: scale(0.95);
  opacity: 0.8;
  transition: all 0.1s ease-in-out;
}
</style>
@endpush

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
