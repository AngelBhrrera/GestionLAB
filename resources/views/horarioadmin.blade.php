

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Control de acceso</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">

</head>
<body>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">horario </div>
            <div class="card-body">

                @if ($horario)
            <h1 class="text-center">Horario de {{ $nombre }}: {{ $horario }}</h1>


        @else
            <h1 class="text-center">No tiene horario</h1>
        @endif



        <form method="POST" action="{{ route('admin.horario_guardar_admin') }}">

            @csrf

            <input id="id" name="id"  value={{ $id_prestador }} type = 'hidden'>

            <div class="row justify-content-center">
                <div class="card border-dark mb-3 rounded-lg mx-sm-3">
                    <div class="card-body">

                        <h5 class="text-center">Selecciona tu horario</h5>

                        <select class="form-control" name="horario">

                            @if (isset($horario2))
                            @foreach ($horario2 as $dato )
                                <option value="{{$dato->descripcion}}">{{$dato->descripcion}}</option>
                            @endforeach
                        @endif

                        </select>
                        <br>
                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>

                    </div>

                </div>

            </div>

        </form>

            </div>
          </div>
        </div>
      </div>
    </div>
</body>




    </div>


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
