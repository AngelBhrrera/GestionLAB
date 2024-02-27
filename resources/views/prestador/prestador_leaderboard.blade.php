@extends('layouts/prestador-layout')

@section('subhead')
<style>
.square-box {
    width: 150px; /* Ajusta el ancho a tu preferencia */
    height: 150px; /* Ajusta la altura a tu preferencia */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    border: 1px solid #ccc; /* Puedes ajustar el estilo del borde */
}
.square-box img {
    max-width: 100%; /* Asegura que la imagen se ajuste al contenedor */
    max-height: 100%; /* Asegura que la imagen se ajuste al contenedor */
}
</style>
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">Torneo</li>
    <li class="breadcrumb-item active" aria-current="page">Leaderboard</li>
@endsection

@section('subcontent')

<ul class="nav nav-tabs nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#semanal">Semana</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#mensual">Mes</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#global">Todos 
                        </a>
                    </li>

                </ul>
                
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="semanal">
                        <ul class="nav nav-tabs nav-justified" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active">Posición</a>
                                @foreach ($leaderBoardW as $top)
                                    <p id="leaderBoard" class="nav-link">{{$top->Posicion}}</p>
                                @endforeach
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active">Usuario</a>
                                @foreach ($leaderBoardW as $top)
                                    <p id="leaderBoard"  class="nav-link">{{$top->Inventor}}</p>
                                @endforeach
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active">Experiencia</a>
                                @foreach ($leaderBoardW as $top)
                                    <p id="leaderBoard" class="nav-link">{{$top->experiencia}}</p>
                                @endforeach
                            </li>
                        </ul>
                    </div>
                    
                    <div class="tab-pane fade " id="mensual">
                            <ul class="nav nav-tabs nav-justified " role="tablist">
                                <li class="nav-item ">
                                    <a class="nav-link active">Posición</a>
                                    @foreach ($leaderBoardM as $top)
                                        <p id="leaderBoard" class="nav-link">{{$top->Posicion}}</p>
                                    @endforeach
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link active">Usuario</a>
                                    @foreach ($leaderBoardM as $top)
                                        <p id="leaderBoard" class="nav-link leaderBoard">{{$top->Inventor}}</p>
                                    @endforeach
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link active">Experiencia</a>
                                    @foreach ($leaderBoardM as $top)
                                        <p  id="leaderBoard"class="nav-link">{{$top->experiencia}}</p>
                                    @endforeach
                                </li>
                            </ul>
                    </div>                

                    <div class="tab-pane fade" id="global">
                        <ul class="nav nav-tabs nav-justified" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active">Posición</a>
                                @foreach ($leaderBoard as $top)
                                    <p  id="leaderBoard" class="nav-link">{{$top->Posicion}}</p>
                                @endforeach
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active">Usuario</a>
                                @foreach ($leaderBoard as $top)
                                    <p id="leaderBoard" class="nav-link">{{$top->Inventor}}</p>
                                @endforeach
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active">Experiencia</a>
                                @foreach ($leaderBoard as $top)
                                    <p  id="leaderBoard" class="nav-link">{{$top->experiencia}}</p>
                                @endforeach
                            </li>
                        </ul>
                    </div> 
                </div>
@endsection
