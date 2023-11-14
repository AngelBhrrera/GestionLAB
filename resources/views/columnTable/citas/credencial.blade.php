<form  method="POST" action="{{ route('admin.verCredencial') }}">

    <input  name="descargaName" type="hidden" value="{{$credencial}}">

    <button type="submit" id='eli' class="btn btn-danger">descargar</button>
    @csrf
</form>