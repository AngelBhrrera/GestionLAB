

@if($fecha == "")
   sin actividad
@else

    <form  method="POST" id="formeliminar" action="{{ route('api.proyectos_prestador_terminados') }}">

        @csrf

        <input  name="fecha"  type='hidden' value={{ $fecha }}>
        <input  name="id_usuario"  type='hidden' value={{ $id }}>

        <button type="submit" class="btn btn-primary btn-sm" style="background-color:green" data-toggle="modal" >Ver</button>
    </form>

@endif

