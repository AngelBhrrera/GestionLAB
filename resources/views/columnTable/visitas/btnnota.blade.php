

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reporte </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form method="POST" action="{{ route('nota') }}" enctype="multipart/form-data">
                @csrf
            <div class="modal-body">
                <input id="modalid" name="id" type="hidden" >
                <textarea name="nota" class="form-control" id="myTextarea"  maxlength="255" required {{Auth::user()->tipo != "Superadmin" ? 'disabled' : ""}}>
                </textarea>
                <label class='flex flex-col hover:bg-green-7000 hover:border-green-600 group'>
                    <div class='flex flex-col items-center justify-center pt-7'>
                    <div id="divimage">
                        <img id="imagenSeleccionada" style="max-height: 200px;max-width: 290px;min-height: 200px;min-width: 290px;"  class="py-2 px-3 rounded-lg border-2 border-green-600 mt-1 focus:outline-none focus:ring-2 focus:ring-green-700 focus:border-transparent hover:bg-green-7000 hover:border-green-600">
                    </div>


                    </p>


                    </div>
                </label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

            </div>
            </form>
        </div>
    </div>
</div>

@if($nota == "")
    <button type="button" class="btn btn-primary btn-sm" style="background-color:red" data-toggle="modal" data-target="#modelId" onclick="mymodal('{{$nota}}','{{$id}}','{{$fechaQ}}','{{$fecha}}','{{$origen}}', '{{$srcimagen}}')" >Nota</button>
@else
    <button type="button" class="btn btn-primary btn-sm" style="background-color:green" data-toggle="modal" data-target="#modelId" onclick="mymodal('{{$nota}}','{{$id}}','{{$fechaQ}}','{{$fecha}}','{{$origen}}','{{$srcimagen}}')" >Nota</button>

@endif

<script type="text/javascript">
  function mymodal(nota,id,fecha,fechaAct, origen, imagen){
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
