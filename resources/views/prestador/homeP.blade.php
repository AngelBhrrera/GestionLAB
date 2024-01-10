@extends('layouts/prestador-layout')

@section('breadcrumb')
    <nav aria-label="breadcrumb" class="-intro-x hidden xl:flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('homeP')}}">Prestador</a></li>
            <li class="breadcrumb-item active" aria-current="page">Registro de horas</li>
        </ol>
    </nav>
@endsection

@section('subcontent')

    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">REGISTRO DE HORAS</h2>
    </div>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="impresoras">
                        <ul class="nav nav-tabs nav-justified" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active">Fecha</a>
                                @foreach ($datos as $dato)
                                    <p id="leaderBoard" class="nav-link">{{$dato->fecha}}</p>
                                @endforeach
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active">Hora Entrada</a>
                                @foreach ($datos as $dato)
                                    <p id="leaderBoard" class="nav-link">{{$dato->hora_entrada}}</p>
                                @endforeach
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active">Hora Salida</a>
                                @foreach ($datos as $dato)
                                    <p id="leaderBoard" class="nav-link">{{$dato->hora_salida}}</p>
                                @endforeach
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active">Tiempo</a>
                                @foreach ($datos as $dato)
                                    <p id="leaderBoard" class="nav-link">{{$dato->tiempo}}</p>
                                @endforeach
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active">Horas</a>
                                @foreach ($datos as $dato)
                                    <p id="leaderBoard" class="nav-link">{{$dato->horas}}</p>
                                @endforeach
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active">Estado</a>
                                @foreach ($datos as $dato)
                                    <p id="leaderBoard" class="nav-link">{{$dato->estado}}</p>
                                @endforeach
                            </li>


                        </ul>
            </div>

        </div>

@endsection
