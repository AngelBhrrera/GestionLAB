@extends('layouts/admin-layout')
@section('subhead')
    <style>
        .bootstrap-duallistbox-container .box1,
        .bootstrap-duallistbox-container .box2 {
            width: 48%; /* Ajusta el ancho según tus necesidades */
            display: inline-block;
            vertical-align: top;
            margin-right: 2%;
        }
    </style>
@endsection
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
                <h3 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 10px;"> Crear Nuevo Proyecto </h3>
            </div>
            <div class="card-body pl-10 pr-10">
                <form method="POST" action="{{route('admin.make_act')}}">
                    @if (isset($tipo))
                    <input id="tipo" name="tipo" value={{ $tipo }} type="hidden">
                    @endif
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Primera Columna -->
                        <div class="col-span-1">
                            <div class="form-group row">
                                <label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre del proyecto</label>
                                <div class="col-md-8">
                                    <textarea id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" required>@if(isset($actm)){{$actm[0]->nombre}}@endif</textarea>

                                    @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                           
                        </div>

                        <!-- Segunda Columna -->
                        <div class="col-span-1">
                        <div class="form-group row">
                                <label for="actividades_l" class="col-md-4 col-form-label text-md-right">Actividades</label>
                                <div class="col-md-8">
                                    <select class="form-control" id="actividades_l" name="actividades_l" required>
                                        <option value="">Asignar actividad</option>
                                        @foreach ($actividades as $actividad)
                                        <option value="{{ $actividad->id }}">{{ $actividad->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    
                    <div class="col-span-1">
                        <label for="nombre" class="col-md-4 col-form-label text-md-right">Prestadores</label>
                        <div class="col-md-8">
                            <select class="duallistbox" name="duallistbox_demo1[]" id="opcionPrestadores" multiple="multiple" required>
                                @if (isset($prestadores))
                                    @foreach ($prestadores as $prestador)
                                        <option value="{{$prestador->id}}"> {{$prestador->name." ".$prestador->apellido}} </option>
                                    @endforeach
                                @endif
                            </select>
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
<div style="height: 65px;"></div>

@endsection

@section('script')

{{-- para que funcione todo, nota: este debe importarse primero si no, todo se chinga xd --}}
<script src={{asset('plugins/jquery/jquery.min.js')}}></script>


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

</script>

@endsection