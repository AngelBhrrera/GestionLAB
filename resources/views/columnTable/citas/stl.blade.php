<form  method="POST" action="{{ route('admin.descargarArchivo') }}">

    <input  name="descargaName" type="hidden" value="{{$ArchivoSTL}}">

    <button type="submit" id='eli' class="btn btn-danger">Descargar</button>
    @csrf
</form>