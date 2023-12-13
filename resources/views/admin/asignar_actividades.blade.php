@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">Admin</a></li>
    <li class="breadcrumb-item"><a href="{{route('homeP')}}">Registro</a></li>
    <li class="breadcrumb-item active" aria-current="page">Actividades</li>
@endsection

@section('subcontent')

    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            Registro de Actividades 
                        </div>

                        <div class="card-body">

                                @if (isset($tipo))
                                <input id="tipo" name="tipo"  value={{ $tipo }} type="hidden">
                                @endif
                                @csrf

                                <div class="form-group row">
                                    <label for="tipo_categoria" class="col-md-4 col-form-label text-md-right">Filtro categoria</label>
                                    <div class="col-md-6">
                                    <select class="form-control" id="tipo_categoria" name="tipo_categoria" required onchange="filtrarActividades()">    
                                        <option value="">Selecciona una categoría</option>
                                        @foreach ($categorias as $categoria)
                                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="actividades_l" class="col-md-4 col-form-label text-md-right">Actividades</label>
                                    <div class="col-md-6">
                                    <select class="form-control" id="actividades_l" name="actividades_l" required>    
                                        <option value="">Asignar actividad</option>
                                        @foreach ($actividades as $actividad)
                                            <option value="{{ $actividad->id }}">{{ $actividad->nombre }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nombre" class="col-md-4 col-form-label text-md-right">Prestadores</label>
                                    <div class="col-md-6">

                                        <select class="duallistbox" name="duallistbox_demo1[]" id="opcionPrestadores" multiple="multiple" required >
                                            @if (isset($prestadores))
                                            @foreach ($prestadores as $prestador)
                                                <option value="{{$prestador->id}}" > {{$prestador->name." ".$prestador->apellido}} </option>
                                             @endforeach
                                        @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tiempo_estimado" class="col-md-4 col-form-label text-md-right">Tiempo estimado</label>
                                    <div class="col-md-6">
                                        <div class="input-group date" id="datetimepicker" data-target-input="nearest">
                                            <input name="horas" type="number" class="form-control" placeholder="Horas" min="0" max="23" step="1" value="{{ isset($actm[0]->horas) ? $actm[0]->horas : old('horas') }}">
                                            <input name="minutos" type="number" class="form-control" placeholder="Minutos" min="0" max="59" step="1" value="{{ isset($actm[0]->minutos) ? $actm[0]->minutos : old('minutos') }}">
                                        </div>
                                    </div>
                                </div>
                                   
                                
                            <div class="col-md-12 text-right" >
                                    <button style="" type="submit" id='enviar' class="btn btn-primary from-prevent-multiple-submits ">Enviar</button>
                                </div>
   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

@endsection

@section('script')

{{-- para que funcione todo, nota: este debe importarse primero si no, todo se chinga xd --}}
<script src={{asset('plugins/jquery/jquery.min.js')}}></script>

<!-- AdminLTE App -->
{{-- para que funcionen los componentes de adminlte como los botones laterales xd --}}
<script src={{asset('dist/js/adminlte.min.js')}}></script>

{{-- componentes necesarios para que funcione el dualistbox --}}
<script src={{asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}></script>
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>

<script type="text/javascript">

    var demo1 = $('select[name="duallistbox_demo1[]"]').bootstrapDualListbox({
        preserveSelectionOnMove: 'Mover ',
        moveAllLabel: 'Mover todo',
       removeAllLabel: 'Borrar todo'
    });


  $(function () {

            $('#datetimepicker').datetimepicker({ icons: { time: 'far fa-calendar' },
                 minDate:new Date(),
                daysOfWeekDisabled: [0],
                format: 'DD/MM/YYYY HH:mm',

            });
        });

</script>

<script>
    $(function () {
        $('#timepicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
            defaultDate: moment(),
            icons: {
                time: 'far fa-clock'
            }
        });

        // Cuando cambie la hora o los minutos, actualizar el campo time_estimado
        $('#horas, #minutos').on('change', function () {
            var horas = $('#horas').val();
            var minutos = $('#minutos').val();
            var fecha = moment($('#timepicker').datetimepicker('date'));

            fecha.hours(horas);
            fecha.minutes(minutos);

            $('input[name="time_estimado"]').val(fecha.format('YYYY-MM-DD HH:mm'));
        });
    });
</script>


<script>
    function filtrarActividades() {
        var categoriaSelect = document.getElementById('tipo_categoria');
        var actividadSelect = document.getElementById('tipo_actividad');

        var categoriaId = categoriaSelect.value;

        actividadSelect.innerHTML = '<option value="">Selecciona una actividad</option>';

        if (categoriaId === '') {
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var actividades = JSON.parse(xhr.responseText);

                    actividades.forEach(function(actividad) {
                        var option = document.createElement('option');
                        option.value = actividad.id;
                        option.text = actividad.nombre;
                        actividadSelect.appendChild(option);
                    });
                } else {
                    console.error('Error al obtener las actividades');
                }
            }
        };

        // xhr.open('GET', '/obtenerActividades?categoriaId=' + categoriaId);
        xhr.open('GET', '{{ route('obtenerActividades') }}?categoriaId=' + categoriaId);

        xhr.send();
    }
</script>
@endsection