
@extends('layouts/prestador-layout')

@section('subcontent')

<head>
    <link rel="stylesheet" href={{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}>
    <link rel="stylesheet" href={{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}>
    <link rel="stylesheet" href={{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}>
    <link rel="stylesheet" href={{ asset('css/dobletabla.css') }}>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<div class="container">
    <h1 class="text-center">
        @isset($title)
            {{ $title }}
        @else
            Mis Actividades
        @endisset
    </h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">Listado de Actividades</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Descripción</th>
                  <th scope="col">Objetivo</th>
                  <th scope="col">Fecha</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Estimación Tiempo</th>
                  {{-- <th scope="col">Imagen</th>
                  <th scope="col">Archivo</th> --}}
                  @if ($actividades->where('status', 'terminado_revisado')->count() > 0)
                    <th scope="col">Duración</th>
                    <th scope="col">Experiencia obtenida</th>
                  @elseif ($actividades->where('status', 'terminado')->count() > 0)
                    <th scope="col">Duración</th>
                  @elseif ($actividades->where('status', 'cancelado')->count() > 0 || $actividades->where('status', 'cancelado_permitido')->count() > 0)
                    <th scope="col">Nota de error</th>
                  @elseif ($actividades->where('status', 'creado')->count() > 0)
                    <th scope="col">Solicitar cancelación</th>
                  @endif
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($actividades as $actividad)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        @if ($actividad->status == 'creado')
                            <td>{{ $actividad->nombre_act }}</td>
                            <td>{{ $actividad->descripcion }}</td>
                            <td>{{ $actividad->objetivo }}</td>
                            <td>{{ $actividad->fecha }}</td>
                            <td>{{ $actividad->status }}</td>
                            <td>{{ $actividad->estimacion_tiempo }}</td>
                            <td>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cancelacionModal{{ $actividad->id_actividad }}">
                                        Solicitar cancelación
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="cancelacionModal{{ $actividad->id_actividad }}" tabindex="-1" role="dialog" aria-labelledby="cancelacionModalLabel{{ $actividad->id_actividad }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="cancelacionModalLabel{{ $actividad->id_actividad }}">Solicitud de cancelación</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{ route('cancelacion_prestador') }}">
                                                        @csrf
                                                        <input type="hidden" name="id_actividad" value="{{ $actividad->id_actividad }}">
                                                        <div class="form-group">
                                                            <label for="motivo_cancelacion{{ $actividad->id_actividad }}">Motivo de cancelación</label>
                                                            <textarea class="form-control" id="motivo_cancelacion{{ $actividad->id_actividad }}" name="motivo_cancelacion" rows="3" required></textarea>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Enviar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </td>
                            <td>
                                @if ($actividad->status == 'creado')
                                <form action="{{ route('enProcesoActividad', $actividad->id_actividad) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">Comenzar</button>
                                </form>
                                @endif

                            </td>
                        @elseif ($actividad->status == 'en_proceso')
                            <td>{{ $actividad->nombre_act }}</td>
                            <td>{{ $actividad->descripcion }}</td>
                            <td>{{ $actividad->objetivo }}</td>
                            <td>{{ $actividad->fecha }}</td>
                            <td>{{ $actividad->status }}</td>
                            <td>{{ $actividad->estimacion_tiempo }}</td>
                            <td>
                                @if ($actividad->status == 'en_proceso')
                                <form action="{{ route('terminarActividad', $actividad->id_actividad) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-primary">Terminar</button>
                                </form>
                                @endif
                            </td>
                        @elseif ($actividad->status == 'terminado')
                            <td>{{ $actividad->nombre_act }}</td>
                            <td>{{ $actividad->descripcion }}</td>
                            <td>{{ $actividad->objetivo }}</td>
                            <td>{{ $actividad->fecha }}</td>
                            <td>{{ $actividad->status }}</td>
                            <td>{{ $actividad->estimacion_tiempo }}</td>
                            <td>{{ $actividad->duracion }}</td>
                        @elseif ($actividad->status == 'terminado_revisado')
                            <td>{{ $actividad->nombre_act }}</td>
                            <td>{{ $actividad->descripcion }}</td>
                            <td>{{ $actividad->objetivo }}</td>
                            <td>{{ $actividad->fecha }}</td>
                            <td>{{ $actividad->status }}</td>
                            <td>{{ $actividad->estimacion_tiempo }}</td>
                            <td>{{ $actividad->duracion }}</td>
                            <td>{{ $actividad->experiencia_obtenida }}</td>
                        @elseif ($actividad->status == 'cancelado' || $actividad->status == 'cancelado_permitido')
                            <td>{{ $actividad->nombre_act }}</td>
                            <td>{{ $actividad->descripcion }}</td>
                            <td>{{ $actividad->objetivo }}</td>
                            <td>{{ $actividad->fecha }}</td>
                            <td>{{ $actividad->status }}</td>
                            <td>{{ $actividad->estimacion_tiempo }}</td>
                            <td>{{ $actividad->nota_error }}</td>
                            <td>
                                @if ($actividad->status == 'cancelado_permitido')
                                <form action="{{ route('retomarActividad', $actividad->id_actividad) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">Retomar actividad</button>
                                </form>
                                @endif
                            </td>

                        @endif
                    </tr>

                    @endforeach

              </tbody>
            </table>

            <a href="{{ url()->previous() }}" class="btn btn-primary">Volver</a>

          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<main class="py-4">
    @yield('content')
</main>

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
