{{-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modelact" onclick="modalact({{json_encode($actividad)}})">
    Ver
</button> --}}

{{-- <button type="button" class="btn btn-primary" onclick="window.open('/admin/actividades_revision/{{ $actividad->id_actividad }}', '_blank')">Revisar</button> --}}
{{-- <button type="button" class="btn btn-primary" onclick="window.open('/admin/actividades_revision/{{ $actividad->id_actividad }}/detalles')">Revisar</button> --}}
<button type="button" class="btn btn-primary" onclick="window.location.href='/admin/actividades_revision/{{ $actividad->id_actividad }}/detalles'">Revisar</button>
{{-- <button type="button" class="btn btn-primary" onclick="window.open('{{ route('actividad.detalles', $actividad->id_actividad) }}', '_blank')">Revisar</button> --}}


<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modelId" onclick="modelId('{{ $actividad->id_actividad  }}')">
  Revisado
</button> --}}


<form method="POST" action="{{ route('admin.actividad_cancelar') }}">

    @csrf

    <input id="id" name="id"  value= {{ $actividad->id_actividad }} type='hidden' >

    {{-- <button type="submit" class="btn btn-danger"  >
       cancelar petición
      </button> --}}

      <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#cancelModal">
        Solicitar correcciones
      </button>
      

</form>

<div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cancelModalLabel">Motivo de la cancelación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="cancelForm" method="POST" action="{{ route('admin.actividad_cancelar') }}">
          @csrf
          <input id="cancelId" name="id" value="{{ $actividad->id_actividad }}" type="hidden">
          <div class="form-group">
            <label for="cancelNote">Nota:</label>
            <textarea class="form-control" id="cancelNote" name="nota_error" rows="3"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-warning" onclick="cancelarActividad()">Confirmar petición correcciones</button>
      </div>
    </div>
  </div>
</div>

<script>
  
  
  function cancelarActividad() {
    var nota_error = document.getElementById("cancelNote").value;
    if (nota_error.trim() === "") {
      alert("Por favor ingrese el motivo de la cancelación.");
      return;
    }
    document.getElementById("cancelForm").submit();
  }
  </script>





