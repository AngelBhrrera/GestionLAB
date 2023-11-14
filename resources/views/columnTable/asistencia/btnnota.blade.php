
@if($nota == "")
    <button type="button" class="btn btn-primary btn-sm" style="background-color:red" data-toggle="modal" data-target="#modelIda" onclick="mymodalnota('{{$nota}}','{{$id}}','{{$fechaQ}}','{{$fecha}}','{{$origen}}', '{{$srcimagen}}')" >Reporte</button>
@else
    <button type="button" class="btn btn-primary btn-sm" style="background-color:green" data-toggle="modal" data-target="#modelIda" onclick="mymodalnota('{{$nota}}','{{$id}}','{{$fechaQ}}','{{$fecha}}','{{$origen}}','{{$srcimagen}}')" >Reporte</button>

@endif

<script type="text/javascript">
  function mymodalnota(nota,id,fecha,fechaAct, origen, imagen){
    $('#modelId').modal({
        keyboard: true,
        backdrop: "static",
        show:false,

    })

    if(imagen){
        var img = document.getElementById('divimage');
        img.style.display='block';
    }else{
        var img = document.getElementById('divimage');
        img.style.display='none';
    }
        //make your ajax call populate items or what even you need
    document.getElementById("myTextarea").value = nota;
    document.getElementById("modalid").value = id;
    document.getElementById("imagenSeleccionada").src = "../imagen/notas/"+imagen;
    // if((fecha != fechaAct) || ("{{ Auth::user()->tipo }}" == "prestador"  || ("{{ Auth::user()->tipo }}" == "Superadmin" && origen != 'Superadmin' ) || ("{{ Auth::user()->tipo }}" == "admin" && origen != 'checkin' ))){
    if("{{ Auth::user()->tipo }}" == "prestador"){
        document.getElementById("guardarBtn").disabled = true;
        document.getElementById("myTextarea").readOnly = true;
    }
    else{
        document.getElementById("guardarBtn").disabled = false;
        document.getElementById("myTextarea").readOnly = false;
    }
}

</script>
