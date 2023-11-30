{{-- <button type="button" class="btn btn-info"data-toggle="modal" data-target="#modelact" onclick="modalact({{json_encode($actividad)}})">
    ver
</button> --}}

<form method="POST" id="formcita" action="{{ route('admin.actividad_modificar') }}">

    @csrf

    <button type="submit" class="btn btn-info">
        Editar
    </button>
    <input id="id" name="id"  value={{$id_actcreada}} type="hidden">


</form>



{{-- <a id='mod' class="btn btn-info" href="/admin/mod?id={{$id_actcreada}}&llave=prueba%24buena19/04/2022$2417:56:25" >editar</a> --}}
