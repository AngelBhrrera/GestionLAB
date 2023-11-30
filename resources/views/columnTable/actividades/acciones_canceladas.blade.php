<form method="POST" id="formcita" action="{{ route('admin.actividad_cancelada') }}">

    @csrf

    <button type="submit" class="btn btn-warning">
        Reasignar
    </button>
    <input id="id" name="id" value={{$id_actcreada}} type="hidden">
</form>