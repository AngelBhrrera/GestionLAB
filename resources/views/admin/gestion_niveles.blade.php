@extends('layouts/admin-layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{$userRol=ucfirst(Auth::user()->tipo)}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">Gestion de Niveles</li>
@endsection

@section('subcontent')
<h2 class="text-2xl font-medium leading-none mt-3 pl-10" style="padding-top: 20px; padding-bottom: 20px;">
    Lista Niveles
</h2>
<div id="players"></div>
@endsection

@section('script')
    <script type="text/javascript">

            var niveles = {!! $lvls !!};

            var table = new Tabulator("#players", {
                data: niveles,
                layout: "fitColumns",
                resizableColumns: false,  
                columns: [{
                        title: "Nivel",
                        field: "nivel",
                        sorter: "number",
                    }, {
                        title: "Nombre",
                        field: "nombre_insignia",
                        sorter: "string",
                    }, {
                        title: "Experiencia necesaria",
                        field: "experiencia",
                        sorter: "number",
                        editor: "input",
                        cellEdited: function (cell) {
                            var row = cell.getRow();
                            var lvl = row.getData().nivel;
                            var value = cell.getValue();
                            editarXP(lvl, value);
                        },
                    }, 
                ],
            });

            function editarXP(lvl, value) {
            const token = document.head.querySelector('meta[name="csrf-token"]').content;
            fetch(`editarXP/${lvl}/${value}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                },
            })
            .then(response => response.json())
            .then(data => {
                console.log('Experiencia modificada', data);
                window.location.reload();
            })
            .catch(error => {
                console.error('Error al modificar experiencia:', error);
            });
        } 
            
    </script>
@endsection