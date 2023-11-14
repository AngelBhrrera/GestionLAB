<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalprestadoresact" onclick="modalprestadoresact('{{$id}}')">
    Activar
  </button>


  <script type="text/javascript">
      function modalprestadoresact(id){
          $('#modalprestadoresact').modal({
              keyboard: true,
              backdrop: "static",
              show:false,
          })

          document.getElementById("idusuarioactivar").value = id;

      }
  </script>
