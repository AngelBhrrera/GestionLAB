
    <div class="col-12">
        <input class="form-control"
        type="number"
        value={{$horas}}
        name={{$id}}
        id={{"inputh".$id}}
        onkeyup="actualizarb(this, {{ Auth::user() }})"
        onchange="actualizarb(this, {{ Auth::user() }})"
        {{(Auth::user()->tipo != 'Superadmin' && Auth::user()->tipo != 'admin') ? 'disabled' : ''}}
        > 
    </div>

<script type="text/javascript">
    //actualizar horas
    function actualizarb(src, responsable){

    var url = '{{route('api.actualizarb')}}';
    var horas = src.value;
    var nombre = src.name;

    //alert(responsable.id+" "+responsable.name+" "+responsable.apellido);

    if(src.value == ""){
        horas = 0;
    }
    $.ajax({
        type:"POST",
        url: url,
        data:{
                "_token": "{{ csrf_token() }}",
                "id":src.name,
                "horas":horas,
                "responsable":responsable.id+" "+responsable.name+" "+responsable.apellido

        },
        }
        );
    }
</script>
