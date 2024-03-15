@extends('layouts/admin-layout')
@section('subhead')
<style>
.tooltip {
    cursor: pointer;
}

.tooltip-info {
    background-color: #f9f9f9;
    border: 1px solid #ccc;
    padding: 10px;
    position: absolute;
    z-index: 999;
}
</style>
<link rel="stylesheet" href="{{asset('build/assets/css/registro_proyecto_actividadess.css')}}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('homeP')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
<li class="breadcrumb-item"><a href="{{route('admin.proyHub')}}">Proyecto</a></li>
<li class="breadcrumb-item active" aria-current="page">Crear</li>
@endsection

@section('subcontent')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="grid grid-cols-12 gap-6 mt-5">
                <div class="intro-y ml-5 col-span-12 lg:col-span-6 flex justify-center" id="alerta">
                    @if (session('success'))
                        <div class="alert mb-5 alert-success w-full px-4">{{session('success')}}</div>
                    @endif
                    @if(session('warning'))
                        <div class="alert mb-5 alert-warning w-full px-4">{{session('warning')}}</div>
                    @endif
                    @error('nombre')
                        <div class="alert mb-5 alert-danger w-full px-4">{{$message}}</div>
                    @enderror
                        </div>
                </div>
            </div>
            <div class="card card-primary" id="crear_proyecto">
                <h3 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 10px;"> Crear Nuevo Proyecto </h3>
            </div>
            <div class="card-body pl-10 pr-10" id="crear_proyecto_2">
                <form id="enviar" method="POST" action="{{route('admin.make_proy')}}">
                    @csrf
                    @if (isset($tipo))
                    <input id="tipo" name="tipo" value={{ $tipo }} type="hidden">
                    @endif

                    <div class="form-group row" >
                        <label style="font-weight: bold; font-size: 1.2em;" for="nombre" class="col-md-4 col-form-label text-md-right">Titulo del proyecto</label>
                        <div class="col-md-8">
                            <input id="t_proyecto" name="t_nombre" type="text" class="form-control"  placeholder="Ingresa el titulo del proyecto" required></input>
                        </div>
                    </div>
                    <div class="form-group">
                            <label style="font-weight: bold; font-size: 1.2em;" for="tipo_categoria">Seleccionar area</label>
                            <span class="tooltip" title="Los proyectos deben formar parte de un area de trabajo, tus areas de trabajo estan limitadas por tu rol en el sistema. No puedes crear proyectos en areas o sedes a las que no perteneces">ℹ️</span>
                            <select class="form-control" id="area" name="area" required  onchange="filtroArea()">
                                <option value="">Selecciona el area de trabajo donde estará principalmente el proyecto</option>
                                @foreach ($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->nombre_area }}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="form-group">
                        <label style="font-weight: bold; font-size: 1.2em;" for="horarios" class="form-label">Turno</label>
                        <span class="tooltip" title="Incluir un turno para el proyecto permite clasificar los proyectos por el horario en el que se trabaja en cada uno">ℹ️</span>
                          
                            <select class="form-control" name="horario" id="horarios" disabled>
                                <option selected id="0" value="">Seleccione un turno</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold; font-size: 1.2em;" for="horarios" class="form-label">Particular</label>
                            <span class="tooltip" title="Los proyectos particulares tienen un numero finito de prestadores que lo conforman y solo se le pueden asignar actividades a esos prestadores. Use un proyecto no particular cuando se realicen actividades generales que cualquier prestador podria realizar.">ℹ️</span>
                            <br>
                            <input id="checkbox" name="particular" class="form-check-input" type="checkbox" checked>
                        </div>
                    <div class="container" id="card_duelist_box">
                        <div class="row justify-content-center">
                            <label style="font-weight: bold; font-size: 1.2em;" for="nombre" class="col-md-4 col-form-label text-md-right">Prestadores</label>
                            <div class="col-md-8"> 
                                <select class="select2" name="prestadores_seleccionados[]" id="prestadores_seleccionados" multiple>  
                                    @if (isset($prestadores))
                                    @foreach ($prestadores as $prestador)
                                    <option value="{{$prestador->id}}">{{$prestador->name." ".$prestador->apellido}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <small id="Help" class="form-text text-muted">Selecciona a los prestadores que formaran parte del proyecto</small>
                        </div>
                        <button id="boton_crear" type="submit" class="btn btn-primary from-prevent-multiple-submits">Crear proyecto</button>
                    </div>
                    <br>
                </form>
            </div>
        </div>
    </div>
</div>


<div style="height: 45px;"></div>

@endsection

@section('script')

    <script type="text/javascript">

        document.getElementById('enviar').addEventListener('submit', function(event) {

            const prestadorSelect = document.getElementById('prestadores_seleccionados');
            const check = document.getElementById('checkbox');

            if (prestadorSelect.selectedOptions.length === 0) {
                
                if(check.checked){
                    event.preventDefault();
                    alert('Por favor, selecciona al menos un prestador.');
                }        
            }
        });

        let dlb2 = new DualListbox('.select2', {
            availableTitle: 'Prestadores disponibles',
            selectedTitle: 'Prestadores seleccionados',
            addButtonText: '<span style="color:black;">Agregar</span>',
            removeButtonText: '<span style="color:black;">Quitar</span>',
            addAllButtonText: '<span style="color:black;">Agregar todos</span>',
            removeAllButtonText: '<span style="color:black;">Quitar todos</span>',
            searchPlaceholder: 'Buscar prestadores'
        });
        dlb2.addEventListener('added', function(event) {

        });
        dlb2.addEventListener('removed', function(event) {

        });

        $(document).ready(function() {
            $('.tooltip').click(function() {
                $('.tooltip-info').toggle();
            });
        });

        function filtroArea() {
        var areaSelect = document.getElementById('area');
        var horarioSelect = document.getElementById('horarios');

        var area = areaSelect.value;
        horarioSelect.innerHTML = '<option value="">Selecciona un horario</option>';

        var horariosMapping = {
            'turnoMatutino': 'Matutino',
            'turnoMediodia': 'Mediodia',
            'turnoVespertino': 'Vespertino',
            'turnoSabatino': 'Sabatino',
            'turnoTiempoCompleto': 'TC'
        };

        if (area === '') {
            horarioSelect.disabled = true;
        } else {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var horariosArea = JSON.parse(xhr.responseText);
                        horarioSelect.disabled = false;
                        if (horariosArea[0].turnoMatutino === 1) {
                            var option1 = document.createElement('option');
                            option1.value = 'Matutino';
                            option1.text = 'Matutino';
                            horarioSelect.appendChild(option1);
                        }
                        if (horariosArea[0].turnoMediodia === 1) {
                            var option1 = document.createElement('option');
                            option1.value = 'Mediodia';
                            option1.text = 'Mediodia';
                            horarioSelect.appendChild(option1);
                        }
                        if (horariosArea[0].turnoVespertino === 1) {
                            var option1 = document.createElement('option');
                            option1.value = 'Vespertino';
                            option1.text = 'Vespertino';
                            horarioSelect.appendChild(option1);
                        }
                        if (horariosArea[0].turnoSabatino === 1) {
                            var option1 = document.createElement('option');
                            option1.value = 'Sabatino';
                            option1.text = 'Sabatino';
                            horarioSelect.appendChild(option1);
                        }
                        if (horariosArea[0].turnoTiempoCompleto === 1) {
                            var option1 = document.createElement('option');
                            option1.value = 'TC';
                            option1.text = 'TC';
                            horarioSelect.appendChild(option1);
                        }
                    } else {
                        console.error('Error al obtener horarios');
                    }
                }
            };
            xhr.open('GET', 'area/' + area); 
            xhr.send();
        }
    }

    </script>

@endsection