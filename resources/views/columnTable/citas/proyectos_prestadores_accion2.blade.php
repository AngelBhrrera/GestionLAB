
<div class="row">



    @if ($status == "impresion_terminar")

    <form  method="POST" action="{{ route('api.impresion_terminada') }}">

        <input  name="id_impresion" type="hidden" value="{{ $id_impresion }}">


        <button type="submit" id='eli' class="btn btn-success">Aceptar peticion</button>
        @csrf
    </form>

    @endif


    <form  method="POST" action="{{ route('api.eliminar_prestadores_impresion') }}">

        <input  name="id_impresion" type="hidden" value="{{ $id_impresion }}">


        <button type="submit" id='eli' class="btn btn-danger">eliminar prestadores</button>
        @csrf
    </form>


</div>
