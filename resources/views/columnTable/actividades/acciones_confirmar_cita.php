<button type="button" class="btn btn-info"data-toggle="modal" data-target="#modelact" onclick="modalact({{json_encode($actividad)}})">
    ver
</button>
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modeldelete"
    onclick="modaleliminar('{{$id_actividad}}','actividades','{{$nombre_act}}','actividades')">
    borrar
</button>
