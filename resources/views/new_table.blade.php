<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" >
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
        <link  href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    </head>

    <body>
        <div class="container mt-2">
            <div class="row">
            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div class="card-body">
                <table class="table table-bordered" id="ajax-crud-datatable">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Entrada</th>
                            <th>Salida</th>
                            <th>Tiempo</th>
                            <th>Horas</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        
        <script type="text/javascript">
        
            $('#ajax-crud-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('prestador.index') }}",
                columns: [
                    { data: 'fecha', name: 'id' },
                    { data: 'hora_entrada', name: 'name' },
                    { data: 'hora_salida', name: 'email' },
                    { data: 'tiempo', name: 'address' },
                    { data: 'horas', name: 'created_at' },
                    { data: 'estado', name: 'action'},
                ],
                order: [[0, 'desc']]
            });

        </script>
        
    </body>
</html>