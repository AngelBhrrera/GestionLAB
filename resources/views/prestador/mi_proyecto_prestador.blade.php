@extends('layouts/prestador-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('actHub')}}">Actividades</a></li>
    <li class="breadcrumb-item active" aria-current="page">Mi proyecto</li>
@endsection

@section('subcontent')
    
        @if(count($proyecto) != 0)
            @for ($i=0; $i < count($proyecto); $i++)
            <div class="intro-y box p-5 mt-5">
                <h2 class="text-2xl font-medium leading-none mt-3" style="padding-top: 20px; padding-bottom: 20px;">
                    Detalles de Proyecto
                </h2>
                    <h3 class="text-xl font-medium leading-none">{{$proyecto[$i][0]->titulo}}</h3><br>
                    <h3 class="text-xl font-medium leading-none">{{"Turno: ".$proyecto[$i][0]->horario}}</h3>
                    <br>
                    <h3 class="text-xl font-medium leading-none mt-3">--Integrantes--</h3>
                        <div class="overflow-x-auto">
                            <table class="table" >
                                <thead>
                                    <tr>
                                        <th class="whitespace-nowrap">Prestador</th>
                                        <th class="whitespace-nowrap">Correo</th>
                                        <th class="whitespace-nowrap">Teléfono</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($prestadores[$i] as $prestador )
                                        <tr>
                                            <td>{{$prestador->name." ".$prestador->apellido}}</td>
                                            <td>{{$prestador->correo}}</td>
                                            <td>{{$prestador->telefono}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <h3 class="text-xl font-medium leading-none mt-3">Actividades</h3>
                        <div class="overflow-x-auto" style="max-height: 250px; overflow-y: auto;">
                            <table class="table">
                                <thead>

                                    <tr>
                                        <th class="whitespace-nowrap">Actividad</th>
                                        <th class="whitespace-nowrap">Estado</th>
                                        <th class="whitespace-nowrap">Asignado a</th>
                                        <th class="whitespace-nowrap"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($actividades[$i] as $actividad )
                                        <tr>
                                            <td>{{$actividad->actividad}}</td>
                                            <td>{{$actividad->estado}}</td>
                                            <td>{{$actividad->prestador}}</td>
                                            <td><a class ="btn btn-primary" href="{{route('detallesActividad', $actividad->actividad_id)}}">Detalles</a></td>
                                        </tr>
                                    @endforeach
                                    @for ($x=0; $x < 50; $x++)
                                        <tr>
                                            <td>{{$x}}</td>
                                            <td>{{$x}}</td>
                                            <td>{{$x}}</td>
                                            <td><a class ="btn btn-primary" href="#">detalles</a></td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center mx-auto" style="padding-left: 10px" id="actividades"></div>
                    </div>
                @endfor
        @else
            <h3 class="text-xl font-medium leading-none">No tienes un proyecto asignado ☹ </h3>
        @endif
    

@endsection

@section('script')

@endsection

