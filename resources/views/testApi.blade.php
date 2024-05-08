@extends('layouts/admin-layout')

@section('subhead')
<style>
    #prestadoresTable {
        font-size: 18px; /* Ajusta el tamaño de la letra */
        width: 100%;
        border-collapse: collapse;
    }
    #prestadoresTable th, #prestadoresTable td {
        border: 1px solid #ddd;
        padding: 8px;
    }
    #prestadoresTable tr:nth-child(even){background-color: #0047AB;}
    #prestadoresTable tr:hover {background-color: #ddd; color:black;}
    #prestadoresTable th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #0047AB;
        color: white;
    }
    .excelente { color: greenyellow; font-weight: bold;  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7); }
    .bueno { color: cyan; font-weight: bold;  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7); }
    .aceptable { color: gold; font-weight: bold; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7); }
    .regular { color: orange; font-weight: bold; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7); }
    .deficiente { color: red; font-weight: bold;  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);}
    .tom-select .ts-dropdown-inner {
        background-color: #333;
    }
    .tom-select .ts-selected {
        background-color: #ff7f00;
    }
    button {
        padding: 5px; 
        border: 2px solid white; 
        background-color: #ff7f00; 
        color: white; 
        font-size: 1.2em; 
        border-radius: 5px; 
        cursor: pointer; 
    }

    label {
        text-align: center; 
        font-size: 1.7em;
    }

</style>
@endsection()

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
<li class="breadcrumb-item active" aria-current="page">Predictor</li>
@endsection

@section('subcontent')
<div style="text-align: center; padding-top: 15px;">
    <h1 style="color: white; font-size: 2em;">Apoyo de predicción para la asignación de actividades</h1>
</div>
<div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
    <div class="col-span-12 sm:col-span-6 " style=" display: flex; justify-content: center;">
        <div class="intro-y box p-5 mt-5" >
        <form id="miFormulario">
            @csrf
            <label for="horarioSelect" style="color: #fff;">Horario:</label>
            <select class="tom-select" name="otro_dato" id="horarioSelect" style="margin-bottom: 10px;">
                <option value="">Selecciona un horario</option>
                <option value="Matutino">Matutino</option>
                <option value="Mediodia">Mediodia</option>
                <option value="Vespertino">Vespertino</option>
                <option value="Sabatino">Sabatino</option>
            </select>
            <label for="id" style="color: #fff;">Actividad:</label>
            <select class="tom-select" name="id" id="id" style="margin-bottom: 10px;">
                <option value="">Selecciona una actividad</option>
                @foreach($actividades as $actividad)
                    <option value="{{ $actividad->id }}">{{ $actividad->titulo }}</option>
                @endforeach
            </select>
            <button type="submit" >Enviar</button>
        </form>

                <table id="prestadoresTable">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Horario</th>
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
                        const textoIndicadorCell = document.createElement('td'); // Declaración de la variable

                        console.log(recomendacion);

                        const prestador = prestadores.find(p => p.id === recomendacion.id_prestador);
                        if (prestador) {
                            nameCell.textContent = prestador.name + ' ' + prestador.apellido;
                        }

                        const resultado = recomendacion.resultado;
                        if (resultado === 'Excelente') {
                            textoIndicadorCell.className = 'excelente';
                        } else if (resultado === 'Bueno') {
                            textoIndicadorCell.className = 'bueno';
                        } else if (resultado === 'Aceptable') {
                            textoIndicadorCell.className = 'aceptable';
                        } else if (resultado === 'Regular') {
                            textoIndicadorCell.className = 'regular';
                        } else if (resultado === 'Deficiente') {
                            textoIndicadorCell.className = 'deficiente';
                        }
                        const textoIndicador = 'Trabajo ' + resultado + ' esperado';

                        row.appendChild(nameCell);
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