<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Control de acceso</title>

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

                            <input id="id" name="id" value={{ $id_prestador }} type='hidden'>

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