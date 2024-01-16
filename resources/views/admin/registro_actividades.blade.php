@extends('layouts/admin-layout')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('homeP')}}">Admin</a></li>
<li class="breadcrumb-item"><a href="{{route('homeP')}}">Registro</a></li>
<li class="breadcrumb-item active" aria-current="page">Actividades</li>
@endsection

@section('subcontent')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card card-primary">
                <h3 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 10px;"> Crear nueva actividad </h3>
            </div>

            <div class="card-body pl-10 pr-10">

                <form method="POST" action="{{route('admin.make_act')}}">
                    @if (isset($tipo))
                    <input id="tipo" name="tipo" value={{ $tipo }} type="hidden">
                    @endif

                    <input id="id" name="id" type="hidden" value="{{!isset($actm[0]->id) ? old('id') : $actm[0]->id }}">
                    <input name="TipoOriginal" type="hidden" value="{{isset($actm[0]->tipo) ? $actm[0]->tipo : old('TipoOriginal') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre de la actividad</label>

                        <div class="col-md-6">
                            <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{isset($actm[0]->nombre_act) ? $actm[0]->nombre_act : old('nombre') }}" required autocomplete="nombre" autofocus>
                            @error('nombre')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tipo_categoria" class="col-md-4 col-form-label text-md-right">Tipo categoria</label>
                        <div class="col-md-6">
                            <select class="form-control" id="tipo_categoria" name="tipo_categoria" required>
                                <option value="">Selecciona una categoría</option>
                                @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="descripcion" class="col-md-4 col-form-label text-md-right">Descripcion</label>

                        <div class="col-md-6">
                            <textarea id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" required>@if(isset($actm)){{$actm[0]->descripcion}}@endif</textarea>

                            @error('descripcion')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tiempo_estimado" class="col-md-4 col-form-label text-md-right">Tiempo estimado (TEC)</label>
                        <div class="col-md-6">
                            <div class="input-group date" id="datetimepicker" data-target-input="nearest">
                                <input name="horas" type="number" class="form-control" placeholder="Horas" min="0" max="23" step="1" value="{{ isset($actm[0]->horas) ? $actm[0]->horas : old('horas') }}">
                                <input name="minutos" type="number" class="form-control" placeholder="Minutos" min="0" max="59" step="1" value="{{ isset($actm[0]->minutos) ? $actm[0]->minutos : old('minutos') }}">
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12 text-right">
                        <button type="submit" id='enviar' class="btn btn-primary from-prevent-multiple-submits ">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
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


    $(function() {

        $('#datetimepicker').datetimepicker({
            icons: {
                time: 'far fa-calendar'
            },
            minDate: new Date(),
            daysOfWeekDisabled: [0],
            format: 'DD/MM/YYYY HH:mm',

        });
    });
</script>

<script>
    $(function() {
        $('#timepicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
            defaultDate: moment(),
            icons: {
                time: 'far fa-clock'
            }
        });

        // Cuando cambie la hora o los minutos, actualizar el campo time_estimado
        $('#horas, #minutos').on('change', function() {
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