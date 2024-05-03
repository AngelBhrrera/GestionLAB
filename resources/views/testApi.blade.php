@extends('layouts/admin-layout')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
<li class="breadcrumb-item active" aria-current="page">Predictor</li>
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
                <select name="id" id="id">
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

        var idArea = "{{ Auth::user()->area }}";

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
                event.preventDefault(); 

                let idAct = document.getElementById('id').value;
                console.log(idAct);
               
                let turno = document.getElementById('horarioSelect').value;
                console.log(turno);
                console.log(idArea);

                let url = `http://127.0.0.1:5000/predict/${idAct}/${idArea}/${turno}`;

                fetch(url, {
                method: "GET"
                })
                .then(response => {
                    if (!response.ok) {
                        
                    }
                    console.log(response);
                    return response.json();
                })
                .then(data => {

                    const tableBody = document.getElementById('prestadoresTable').getElementsByTagName('tbody')[0];
   
                    tableBody.innerHTML = '';
                    const recomendaciones = data;

                    recomendaciones.forEach(recomendacion => {
                        const row = document.createElement('tr');

                        const nameCell = document.createElement('td');
                        const horarioCell = document.createElement('td');

                        console.log(recomendacion);

                        const prestador = prestadores.find(p => p.id === recomendacion.id_prestador);
                        if (prestador) {
                            nameCell.textContent = prestador.name + ' ' + prestador.apellido;
                        }

                        const resultado = recomendacion.resultado;
                        let textoIndicador = '';
                        if (resultado === 'Excelente') {
                            row.style.color = 'green';
                        } else if (resultado === 'Bueno') {
                            row.style.color = 'blue';
                        } else if (resultado === 'Aceptable') {
                            row.style.color = 'darkgoldenrod';
                        } else if (resultado === 'Regular') {
                            row.style.color = 'orange';
                        } else if (resultado < 'Deficiente') {
                            row.style.color = 'red';
                        }
                        textoIndicador = 'Trabajo ' + resultado + ' esperado';

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
                    console.log(error);
                    console.error('Error:', error);
                });
            });
        </script>
@endsection