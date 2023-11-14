
<div class="row">





    <form  method="POST" action="{{ route('api.documento') }}">

        <input  name="id_impresion" type="hidden" value="{{ $id_impresion }}">
        <input  name="titulo_proyecto" type="hidden" value="{{ $titulo_proyecto }}">
        <input  name="n_piezas" type="hidden" value="{{ $n_piezas }}">
        <input  name="nombre_cliente" type="hidden" value="{{ $nombre_cliente }}">


        <button type="submit" id='eli' class="btn btn-success">Descargar documento</button>
        @csrf
    </form>







</div>
