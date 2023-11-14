<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalprestadores" onclick="modalprestadores('{{$id}}')">
    Desactivar
  </button>

  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_liberar" onclick="modal_liberar('{{$id}}')">
    Liberar Servicio
  </button>

  <!-- Modal -->
  <div class="modal fade" id="modalprestadores" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Advertencia</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
              </div>
              <form method="POST" action="{{ route('api.desactivar_prestadores') }}">
                  <div class="modal-body">
                      @csrf
                      <input id="iddesc" name="iddesc" type="hidden">
                      <h5>¿estas seguro de realizar esta accion?</h5>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      <button type="submit" class="btn btn-primary">Desactivar</button>
                  </div>
              </form>


          </div>
      </div>
  </div>



  <script type="text/javascript">
      function modalprestadores(id){
          $('#modalprestadores').modal({
              keyboard: true,
              backdrop: "static",
              show:false,
          })

          document.getElementById("iddesc").value = id;

      }

      function modal_liberar(id){
          $('#modal_liberar').modal({
              keyboard: true,
              backdrop: "static",
              show:false,
          })

          document.getElementById("id_usuario").value = id;

      }
  </script>
