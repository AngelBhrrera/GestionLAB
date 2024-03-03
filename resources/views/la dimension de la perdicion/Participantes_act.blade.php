<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.2/bootstrap-duallistbox.css">


    </head>
    <body>
        <div class="row justify-content-center">
                <div class="card border-dark mb-3 rounded-lg mx-sm-3">
                    @foreach ($actividades as $actividad)
                    <div class="card-header text-white bg-secondary mb-3 text-center ">
                        <h4 class="card-title">Nombre de la actividad: {{ $actividad->nombre_act}}</h4>
                    </div>

                    <div class="card-body">

                        <label for="" id="id_a" name="id_a">Id del Prestador:{{ $actividad->id_prestador }}</label>
                        <br>
                        <label for="" id="nombre_p" name="nombre_p">Nombre del Prestador: {{ $actividad->nombre_prestador}}</label>
                        <br>
                        <label for="" id="apellido_p" name="apellido_p">Apellido del Prestador: {{ $actividad->apellido_prestador}}</label>
                        <br>

                    </div>
                    @endforeach
                </div>
        </div>
    </body>

</html>

{{-- para que funcione todo, nota: este debe importarse primero si no, todo se chinga xd --}}

<script src={{asset('plugins/jquery/jquery.min.js')}}></script>

<!-- AdminLTE App -->
{{-- para que funcionen los componentes de adminlte como los botones laterales xd --}}
<script src={{asset('dist/js/adminlte.min.js')}}></script>
<!-- Bootstrap 4 -->
<script src={{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}></script>


