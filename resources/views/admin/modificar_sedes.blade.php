@extends('layouts/admin-layout')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
<li class="breadcrumb-item active" aria-current="page">Modificar</li>
<li class="breadcrumb-item active" aria-current="page">Sede</li>
@endsection

@section('subcontent')

    <div class="intro-y col-span-4 lg:col-span-6">
    @if (session('success'))
        <h6 class="alert alert-success">{{ session('success') }}</h6>
    @elseif (session('warning'))
        <h6 class="alert alert-warning">{{ session('warning') }}</h6>
    @elseif ($errors->has('nombre'))
        <h6 class="alert alert-danger">{{ $errors->first('nombre') }}</h6>
    @endif
    </div>

<div class="flex items-center justify-center">

    <div class="intro-y box p-5 mt-5">
    <br>
        <h3 class="text-2xl mt-5 font-medium">Modificar Sede</h3>
        <br>
        <form action="{{route('admin.modificarSede')}}" method="POST">
            @csrf
            <input type="hidden" name="idSede" id="idSede" value="">
            <br>
            <input required type="text" name="nuevoNombre" id="nuevoNombre" style="width: 40%" value="" class="form-control">
            {{--
                            <div class="form-check mr-2 pt-5"><label class="pl-5 pr-5" for="activa">Activa</label><input type="checkbox" class=" w-10 h-10 form-check-input" name="activa" id="activa"></div>
                        <br>
                        --}}
            <h3 class="text-2xl mt-5 font-medium">Turnos disponibles</h3>
            <div class="flex flex-col sm:flex-row mt-2">
                <div class="form-check mr-2 pt-3"> <label class="pl-5 pr-5" for="matutino">Matutino</label><input type="checkbox" class="w-10 h-10 form-check-input" name="matutino" id="matutino"></div>
                <div class="form-check mr-2 pt-3"><label class="pl-5 pr-5" for="mediodia">Medio día</label><input type="checkbox" class="w-10 h-10 form-check-input" name="mediodia" id="mediodia"></div>
                <div class="form-check mr-2 pt-3"><label class="pl-5 pr-5" for="vespertino">Vespertino</label><input type="checkbox" class="w-10 h-10 form-check-input" name="vespertino" id="vespertino"></div>
                <div class="form-check mr-2 pt-3"><label class="pl-5 pr-5" for="sabatino">Sabatino</label><input type="checkbox" class=" w-10 h-10 form-check-input" name="sabatino" id="sabatino"></div>
                <div class="form-check mr-2 pt-3"><label class="pl-5 pr-5" for="completo">Completo</label><input type="checkbox" class=" w-10 h-10 form-check-input" name="completo" id="completo"></div>
            </div>
            <br>
            <h3 class="text-2xl mt-5 font-medium">Vistas disponibles</h3>
            <div class="flex flex-col sm:flex-row mt-2">
                <div class="form-check mr-2 pt-3"> <label class="pl-5 pr-5" for="torneo">Torneo</label><input type="checkbox" class="w-10 h-10 form-check-input" name="matutino" id="matutino"></div>
                <div class="form-check mr-2 pt-3"><label class="pl-5 pr-5" for="impresiones">impresiones</label><input type="checkbox" class="w-10 h-10 form-check-input" name="mediodia" id="mediodia"></div>
                <div class="form-check mr-2 pt-3"><label class="pl-5 pr-5" for="visitas">Visitas</label><input type="checkbox" class="w-10 h-10 form-check-input" name="vespertino" id="vespertino"></div>
                <div class="form-check mr-2 pt-3"><label class="pl-5 pr-5" for="reportes">Reportes</label><input type="checkbox" class=" w-10 h-10 form-check-input" name="sabatino" id="sabatino"></div>
            </div>
            <br>
            <h3 class="text-2xl mt-5 font-medium">Areas disponibles</h3>

            <select class="duallistbox" name="duallistbox_demo[]" id="opcionPrestadores" multiple="multiple" required>
                @foreach ($areas as $registro)
                    <option value="{{ $registro->id }}">{{ $registro->nombre_area }}</option>
                @endforeach
            </select>
            <br>
            <button type="Submit" id="guardar" class="btn btn-primary"> Guardar cambios</button>
        </form>
    </div>
</div>


<div style="height: 65px;"></div>

@endsection

@section('script')

<script src="{{asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>

<script type="text/javascript">
    var demo = $('select[name="duallistbox_demo[]"]').bootstrapDualListbox({
        preserveSelectionOnMove: 'Mover ',
        moveAllLabel: 'Mover todo',
        removeAllLabel: 'Borrar todo',
    });

</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var miInput = document.getElementById('nuevoNombre');
        miInput.value = "{{ $gest->first()->sede_nombre}}";

        datoView = {!! json_encode($gest->first()) !!};

        checks = document.querySelectorAll('.form-check-input');
        const propiedades = ['turnoMatutino', 'turnoMediodia', 'turnoVespertino', 'turnoSabatino', 'turnoTiempoCompleto','torneo', 'impresiones', 'visitas', 'reportes'];
        propiedades.forEach((propiedad, index) => {
            const checkbox = checks[index];
            checkbox.checked = datoView[propiedad] == 1;
        });
    });
</script>

<script>
    function modificarCamposSede() {

        btn_guardar = document.getElementById("guardar");
        selectSede = document.getElementById("sede");
        campoNombre = document.getElementById("nuevoNombre");
        idSede = document.getElementById("idSede");
        checks = document.querySelectorAll('.form-check-input');

        btn_guardar.disabled = false;
        datoSede = JSON.parse(selectSede.value);
        campoNombre.value = datoSede.nombre_sede;
        idSede.value = datoSede.id_sede;
        const propiedades = ['activa', 'turnoMatutino', 'turnoMediodia', 'turnoVespertino', 'turnoSabatino', 'turnoTiempoCompleto'];

        propiedades.forEach((propiedad, index) => {
            const checkbox = checks[index];
            checkbox.checked = datoSede[propiedad] == 1;
        });

        setTimeout(function() {

            document.getElementById("alerta").style.display = "none";

        }, 4000);
    }
</script>

@endsection