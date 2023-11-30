
    <!-- Modal delete-->

    <button type="button" {{Auth::user()->tipo != "Superadmin"  ? 'disabled' : ''}} class="btn btn-primary btn-sm" style="background-color:red" data-toggle="modal" data-target="#modeldelete"  onclick="modaleliminar('{{$id}}','{{$origen}}','{{$codigo}}','{{$origen}}')">
    Eliminar
</button>

<script type="text/javascript">
    function modaleliminar(id,tipo,nombre,opc){
        $('#modeldelete').modal({
            keyboard: true,
            backdrop: "static",
            show:false,
        })

        document.getElementById("idEliminar").value = id;
        document.getElementById("tipoEliminar").value = tipo;
        document.getElementById("txtmodalEliminar").innerHTML ='Usuario: ' + nombre;
        document.getElementById("opcionEliminar").value = opc;

    }
</script>
