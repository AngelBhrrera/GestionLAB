<form  method="POST" action="{{ route('admin.verRender') }}">

    <input  name="descargaName" type="hidden" value="{{$render}}">

    <button type="submit" id='eli' class="btn btn-danger">descargar</button>
    @csrf
</form>