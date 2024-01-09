@extends('layouts/admin-layout')


@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('homeP')}}">Admin</a></li>
<li class="breadcrumb-item active" aria-current="page">Home</li>
@endsection

@section('subcontent')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card card-primary">
                <div class="card-header">
                    <h1 class="card-title">Registros de Check - in</h1>
                </div>

                <div class="containter"> </div>
                <div class="card-body">

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="checkin">

                            <ul class="nav nav-tabs nav-justified" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active">Prestador</a>
                                    @foreach ($tabla as $dato)
                                    <p id="leaderBoard" class="nav-link">{{$dato->responsable}}</p>
                                    @endforeach
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active">Origen</a>
                                    @foreach ($tabla as $dato)
                                    <p id="leaderBoard" class="nav-link">{{$dato->origen}}</p>
                                    @endforeach
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active">Fecha</a>
                                    @foreach ($tabla as $dato)
                                    <p id="leaderBoard" class="nav-link">{{$dato->fecha_actual}}</p>
                                    @endforeach
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active">Entrada</a>
                                    @foreach ($tabla as $dato)
                                    <p id="leaderBoard" class="nav-link">{{$dato->hora_entrada}}</p>
                                    @endforeach
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active">Salida</a>
                                    @foreach ($tabla as $dato)
                                    <p id="leaderBoard" class="nav-link">{{$dato->hora_salida}}</p>
                                    @endforeach
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active">Tiempo</a>
                                    @foreach ($tabla as $dato)
                                    <p id="leaderBoard" class="nav-link">{{$dato->tiempo}}</p>
                                    @endforeach
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active">Horas</a>
                                    @foreach ($tabla as $dato)
                                    <p id="leaderBoard" class="nav-link">{{$dato->horas}}</p>
                                    @endforeach
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active">Tipo</a>
                                    @foreach ($tabla as $dato)
                                    <p id="leaderBoard" class="nav-link">{{$dato->tipo}}</p>
                                    @endforeach
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active">Nota</a>
                                    @foreach ($tabla as $dato)
                                    <p id="leaderBoard" class="nav-link">{{$dato->nota}}</p>
                                    @endforeach
                                </li>

                            </ul>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
    @endsection