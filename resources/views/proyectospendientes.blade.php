
@extends('layouts/app')

@section('content')

<head>
    <link rel="stylesheet" href={{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}>
    <link rel="stylesheet" href={{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}>
    <link rel="stylesheet" href={{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}>
    <link rel="stylesheet" href={{ asset('css/dobletabla.css') }}>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<div class="container">
    <h1 class="text-center">Impresiones Completadas</h1>



    <table id="tablaprestadores" class="table table-bordered table-hover display" >
        <thead>
        <tr>
            @foreach ($datos as $dato )
            <th>{{$dato}}</th>

            @endforeach

        </tr>
        </thead>

      </table>

</div>
@endsection

<script src={{ asset('plugins/jquery/jquery.min.js') }}></script>
<script src={{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}></script>
<!-- AdminLTE App -->
<script src={{ asset('dist/js/adminlte.min.js') }}></script>
      <!-- AdminLTE App -->
<script src={{asset('plugins/datatables/jquery.dataTables.min.js')}}></script>
<script src={{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}></script>
<script src={{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}></script>
<script src={{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}></script>
<script src={{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}></script>
<script src={{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}></script>
<script src={{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}></script>
<script src={{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}></script>
<script src={{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}></script>


<script type="text/javascript">
    $(function () {
        tabla = $("#tablaprestadores").DataTable({
            "order": [[ 0, 'desc' ]],
            serverSide: true,
            buttons:true,
            ajax: {
                url:'{{route($ajaxroute)}}',
                data:{
                        "_token": "{{ csrf_token() }}",
                },
            },
            columns:{!!$columnas!!},
            pageLength: 9,
            ordering: true,

            "responsive": true, "lengthChange": true, "autoWidth": false,
            dom: 'Bfrtip',
            buttons: [
                {extend: 'copy', text: 'Copiar'},
                {extend: 'print', text: 'Imprimir'},
                "csv",
                "excel",
                "pdf",
                ],
            "oLanguage": {
                "sSearch": "Buscar:",
                "sEmptyTable": "No hay informacion que mostrar",
                "sInfo": "Mostrando  del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Showing 0 to 0 of 0 records",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":    "Último",
                    "sNext":    "Siguiente",
                    "sPrevious": "Anterior"
                },
                },


        }).buttons().container().appendTo('#tablaprestadores_wrapper .col-md-6:eq(0)');
        $('.dataTables_length').addClass('bs-select');




    });
</script>
