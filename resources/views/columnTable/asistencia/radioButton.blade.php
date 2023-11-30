@if (isset(Auth::user()->tipo))
    @if ((Auth::user()->tipo =='Superadmin' || Auth::user()->tipo =='admin'))
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-outline-danger {{$estado == "denegado" ? 'active' : ''}}" >
                <input
                    type="radio"
                    value="denegado"
                    name="{{$id}}"
                    onchange="actualizar(this,{{Auth::user()}})"
                    autocomplete="off"
                    {{$estado == "denegado" ? 'checked' : ''}}
                    {{(Auth::user()->tipo != 'Superadmin' && Auth::user()->tipo != 'admin')  ? 'disabled' : ''}}
                    >
                Denegado
            </label>
            <label class="btn btn-outline-warning {{$estado == "pendiente" ? 'active' : ''}}">
                <input type="radio"
                    value="pendiente"
                    name="{{$id}}"
                    onchange="actualizar(this,{{Auth::user()}})"
                    autocomplete="off"
                    {{$estado == "pendiente" ? 'checked' : ''}}
                    {{(Auth::user()->tipo != 'Superadmin' && Auth::user()->tipo != 'admin') ? 'disabled' : ''}}
                    >
                Pendiente
                </label>
                <label class="btn btn-outline-success {{$estado == "autorizado" ? 'active' : ''}}">
                <input type="radio"
                    value="autorizado"
                    name="{{$id}}"
                    onchange="actualizar(this,{{Auth::user()}})"
                    autocomplete="off"
                    {{$estado == "autorizado" ? 'checked' : ''}}
                    {{(Auth::user()->tipo != 'Superadmin' && Auth::user()->tipo != 'admin') ? 'disabled' : ''}}
                    >
                    Autorizado
                </label>
        </div>

        <script type="text/javascript">
            //actualizar estado

            function actualizar(src, responsable){

                var url = '{{route('api.actualizar')}}';


                $.ajax({
                    type:"POST",
                    url: url,
                    data:{
                            "_token": "{{ csrf_token() }}",
                            "id":src.name,
                            "estado":src.value,
                            "responsable": responsable.id+" "+responsable.name+" "+responsable.apellido

                    },
                    }
                    );
            }

        </script>
    @endif
@endif

