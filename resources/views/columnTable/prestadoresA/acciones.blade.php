<input  name="id" type="hidden" value="{{$id}}">
<input  name="TipoOriginal" type="hidden" value="{{$tipo}}">



@if($tipo == 'prestador')

        <a class="btn btn-info dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Acciones de Prestador
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a id='act' class="dropdown-item" type="button"  href={{ route('admin.veractividades', ['id'=>$id, 'nombre'=>$name]) }} >Act. Terminadas</a>
            <a id='act2' class="dropdown-item" type="button"  href={{ route('admin.veractividades_pendientes', ['id'=>$id, 'nombre'=>$name]) }} >Act. Por realizar</a>
            <a id='act3' class="dropdown-item" type="button"  href={{ route('admin.veractividades_completadas', ['id'=>$id, 'nombre'=>$name]) }} > Act. Pendientes por revisar</a>
            <a id='mod' class="dropdown-item" type="button" href="/admin/modificar?id={{$id}}" >editar</a>
            <a class="dropdown-item" type="button"  href={{ route('admin.horarioadmin', ['id'=>$id, 'nombre'=>$name, 'horario'=>$horario]) }} >
                horario
            </a>
            <button class="dropdown-item" type="button" data-toggle="modal" data-target="#modalhoras" onclick="modalhoras('{{$id}}', '{{$name}}')">Asignar horas</button>
            <!-- Button trigger modal -->

            <button class="dropdown-item" type="button" data-toggle="modal" data-target="#modalprestadores" onclick="modalprestadores('{{$id}}')">
            Desactivar
            </button>
        </div>

@else

<a id='mod' class="btn btn-success" type="button" href="/admin/modificar?id={{$id}}" >editar</a>


@endif


<script type="text/javascript">
    function modalprestadores(id){
        $('#modeldelete').modal({
            keyboard: true,
            backdrop: "static",
            show:false,
        })

        document.getElementById("iddesc").value = id;

    }
</script>
