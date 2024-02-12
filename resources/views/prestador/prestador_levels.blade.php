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
    <li class="breadcrumb-item active" aria-current="page">Nivel</li>
@endsection

@section('subcontent')

<div class="col-span-12">
                <div class="card-header">
                    <h3  class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 20px;"> Siguiente nivel </h3>
                </div>
        <div class="box intro-y px-3 pt-3 pb-5">
                    
            <div class="flex flex-col 2xl:flex-row items-center justify-center text-center 2xl:text-left">
                <div class="flex flex-col items-center 2xl:mr-10 mt-5">
                    <div class="box intro-y p-5 mt-5 square-box">
                        <h2 class="text-2xl font-medium">{{$nivel[0]->descripcion}}</h2>
                        <img width="80" height="80" src="{{asset('build/assets/'.$nivel[0]->ruta)}}" alt="Medalla">
                        <h4 class="text-sm font-medium smaller-text">
                            Nivel: {{strval($nivel[0]->nivel)}}
                            Xp: {{strval($nivel[0]->experiencia)}}
                        </h4>
                    </div>
                </div>
                                                                        
                <div class="progress h-4 mt-5">
                    <div class="progress-bar px-5" role="progressbar" aria-valuenow="{{$percent}}" aria-valuemin="0" aria-valuemax="100" style="width:{{$percent}}%;">{{$percent}}%</div>
                </div>

                <div class="flex flex-col items-center 2xl:ml-10 mt-5">
                    <div class="box intro-y p-5 mt-5 square-box">
                        <h2 class="text-2xl font-medium">{{$nivel[1]->descripcion}}</h2>
                        <img width="80" height="80" src="{{asset('build/assets/'.$nivel[1]->ruta)}}" alt="Medalla">
                        <h4 class="text-sm font-medium smaller-text">
                            Nivel: {{strval($nivel[1]->nivel)}}
                            Xp: {{strval($nivel[1]->experiencia)}}
                        </h4>
                    </div>
                </div>
            </div>


        </div>
</div>
@endsection
