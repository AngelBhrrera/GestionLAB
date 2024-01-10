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
                            Registro de Nuevos Proyectos
                        </div>

                        <div class="card-body">

                            <form method="POST" action="{{route('admin.make_act')}}">
                                @if (isset($tipo))
                                <input id="tipo" name="tipo"  value={{ $tipo }} type="hidden">
                                @endif

                                <div class="form-group row">
                                    <label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre del proyecto</label>
                                    <div class="col-md-6">
                                        <textarea id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" required>@if(isset($actm)){{$actm[0]->nombre}}@endif</textarea>

                                        @error('nombre')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

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
                                   
                                
                            <div class="col-md-12 text-right" >
                                    <button type="submit" id='enviar' class="btn btn-primary from-prevent-multiple-submits ">Enviar</button>
                                </div>
                            </form>
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

@endsection