@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.gestHub')}}">Gestion</a></li>
    <li class="breadcrumb-item active" aria-current="page">Sedes</li>
@endsection

@section('subcontent')
<div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
    <div class="col-span-12 sm:col-span-6">
        <div class="intro-y box p-5 mt-5">
            <form id="miFormulario">
                @csrf
                <select name="otro_dato" id="horarioSelect">
                    <option value="">Selecciona un horario</option>
                    <option value="Matutino">Matutino</option>
                    <option value="Mediodia">Mediodia</option>
                    <option value="Vespertino">Vespertino</option>
                    <option value="Sabatino">Sabatino</option>
                </select>
                <select name="id">
                <option value="">Selecciona una actividad</option>
                    @foreach($actividades as $actividad)
                        <option value="{{ $actividad->id }}">{{ $actividad->titulo }}</option>
                    @endforeach
                </select>
                <button type="submit">Enviar</button>
                
            </form>

                <table id="prestadoresTable">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Horario</th>
                            <!-- Agrega más columnas según sea necesario -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prestadores as $prestador)
                        <tr>
                            <td>{{ $prestador->name.' '.$prestador->apellido }}</td>
                            <td>{{ $prestador->horario }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
</div>
@endsection

@section('script')


        <script>
        var prestadores = @json($prestadores);
        document.getElementById('horarioSelect').addEventListener('change', function() {
                var selectedHorario = this.value;
                var prestadoresTable = document.getElementById('prestadoresTable');
                var rows = prestadoresTable.getElementsByTagName('tr');

                // Oculta todas las filas de la tabla
                for (var i = 1; i < rows.length; i++) {
                    var horarioCell = rows[i].getElementsByTagName('td')[1];
                    if (horarioCell) {
                        var horario = horarioCell.textContent || horarioCell.innerText;
                        if (selectedHorario === '' || horario === selectedHorario) {
                            rows[i].style.display = '';
                        } else {
                            rows[i].style.display = 'none';
                        }
                    }
                }
            });

            document.getElementById('miFormulario').addEventListener('submit', function(event) {
                event.preventDefault(); // Evitar que el formulario se envíe de forma predeterminada
                // Obtener los datos del formulario
                const formData = new FormData(event.target);
                // Realizar la solicitud POST
                fetch('recomendaciones', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {

                    console.log(data);
                    const tableBody = document.getElementById('prestadoresTable').getElementsByTagName('tbody')[0];
   
                    tableBody.innerHTML = '';
                    const recomendaciones = JSON.parse(data.recomendaciones);

                    recomendaciones.forEach(recomendacion => {
                        const row = document.createElement('tr');

                        const nameCell = document.createElement('td');
                        const horarioCell = document.createElement('td');
                        

                        const prestador = prestadores.find(p => p.id === recomendacion.id_prestador);
                        if (prestador) {
                            nameCell.textContent = prestador.name + ' ' + prestador.apellido;
                        }

                        const resultado = recomendacion.resultado;
                        let textoIndicador = '';
                        if (resultado === 10) {
                            row.style.color = 'green';
                            textoIndicador = 'Trabajo excelente esperado';
                        } else if (resultado === 8) {
                            row.style.color = 'blue';
                            textoIndicador = 'Trabajo muy bueno';
                        } else if (resultado === 5) {
                            row.style.color = 'yellow';
                            textoIndicador = 'Trabajo aceptable';
                        } else if (resultado === 3) {
                            row.style.color = 'orange';
                            textoIndicador = 'Trabajo regular';
                        } else if (resultado === -3) {
                            row.style.color = 'red';
                            textoIndicador = 'Trabajo insatisfactorio';
                        }

                        row.appendChild(nameCell);
                        row.appendChild(horarioCell);

                        // Crear un elemento <td> para el texto indicador y añadirlo a la fila
                        const textoIndicadorCell = document.createElement('td');
                        textoIndicadorCell.textContent = textoIndicador;
                        row.appendChild(textoIndicadorCell);

                        tableBody.appendChild(row);
                    });
                })
                .catch(error => {
                    // Manejar errores
                    console.error('Error:', error);
                });
            });
        </script>
@endsection