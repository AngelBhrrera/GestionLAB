@extends('layouts.app')

@section('content')
<div class="container">
  <h1 class="gradiente-texto text-center">Medallas:</h1>
  <div class="row justify-content-center">
    @foreach($medallas as $medalla)
    <div class="col-md-3 col-sm-6 mb-4">
      <div class="card profile-medal">
        <div class="medal-wrapper d-flex align-items-center justify-content-center">
          <img src="{{ asset($medalla->ruta) }}" alt="{{ $medalla->descripcion }}" class="card-img-top medal-image" style="width: 100px; height: 100px;">
          <h5 class="card-title text-center">{{ $medalla->descripcion }}</h5>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <a href="{{ url()->previous() }}" class="btn btn-primary">Volver</a>
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

