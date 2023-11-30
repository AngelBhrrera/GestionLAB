<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modelact" onclick="modalact({{json_encode($actividad)}})">
    ver
</button>
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.terminar_actividad') }}">

                @csrf
                <input id="id_actividad2" name="id"  value="" type='hidden'>

                <div class="modal-header">
                    <h5 class="modal-title">Advertencia</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    estas seguro que quieres completar la actividad?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    function modelId(id) {
            $('#modalcomp').modal({
                keyboard: true,
                backdrop: "static",
                show: false,
            })
            //alert(id);
            document.getElementById("id_actividad2").value = id;


        }
</script>
