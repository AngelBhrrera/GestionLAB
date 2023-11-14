@if($hora_salida == null)
    <form method="POST" action="{{ route('api.salidaVisita') }}">
    <input name="id" value="{{$id}}" type="hidden" >
    @csrf
    <button type="submit" class="btn btn-primary btn-sm" style="background-color:red">
        Marcar salida
    </button>
    </form> 
@else
    {{$hora_salida}}
@endif