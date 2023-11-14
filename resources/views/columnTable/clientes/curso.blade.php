<select class="form-control"
    name={{$id}}
    @switch($funcion)
        @case(1)
            onchange="actualizarcursos1(this)"
            @break
        @case(2)
            onchange="actualizarcursos2(this)"
            @break
        @case(3)
            onchange="actualizarcursos3(this)"
            @break
    @endswitch
    >

        <option value={{ $curso }}>{{ $curso }}</option>


        @if ( $curso == 'disponible')
            <option value='pendiente'>Pendiente</option>
            <option value='citado'>Citado</option>
            <option value='completado'>Completado</option>

        @elseif ( $curso == 'pendiente')
            <option value='citado'>Citado</option>
            <option value='disponible'>Disponible</option>
            <option value='completado'>Completado</option>

            @elseif ( $curso == 'citado')
            <option value='pendiente'>Pendiente</option>
            <option value='disponible'>Disponible</option>
            <option value='completado'>Completado</option>

        @elseif ( $curso == 'completado')
        <option value='citado'>Citado</option>
        <option value='pendiente'>Pendiente</option>
        <option value='disponible'>Disponible</option>

        @endif



    @csrf
</select>