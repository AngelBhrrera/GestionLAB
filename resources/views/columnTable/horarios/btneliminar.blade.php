
    <!-- Modal delete-->

    <form  method="POST" id="formeliminar-{{$id}}" action="{{ route('api.eliminarhorario') }}">
        <input  id="idEliminar" name="idEliminar" type="hidden" value="{{$id}}" >

        @csrf

        <button type="submit" {{Auth::user()->tipo != "Superadmin"  ? 'disabled' : ''}} class="btn btn-primary btn-sm" style="background-color:red" >
            Eliminar
        </button>
    </form>

<script type="text/javascript">
    function modaleliminarfecha(id,fecha){
        $('#modeldeletefecha').modal({
            keyboard: true,
            backdrop: "static",
            show:false,
        })

        document.getElementById("idEliminar").value = id;
        document.getElementById("txtmodalEliminar").innerHTML ='Fecha: ' + fecha;

    }
</script>