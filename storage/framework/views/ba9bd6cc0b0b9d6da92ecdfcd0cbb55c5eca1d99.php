


<?php $__env->startSection('content'); ?>

<head>
    <link rel="stylesheet" href=<?php echo e(asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>>
    <link rel="stylesheet" href=<?php echo e(asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>>
    <link rel="stylesheet" href=<?php echo e(asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')); ?>>
    <link rel="stylesheet" href=<?php echo e(asset('css/dobletabla.css')); ?>>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

</head>

<div class="container">
    <h1 class="text-center">Impresiones Completadas</h1>



    <table id="tablaprestadores" class="table table-bordered table-hover display" >
        <thead>
        <tr>
            <?php $__currentLoopData = $datos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dato): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <th><?php echo e($dato); ?></th>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </tr>
        </thead>

      </table>

</div>
<?php $__env->stopSection(); ?>

<script src=<?php echo e(asset('plugins/jquery/jquery.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>></script>
<!-- AdminLTE App -->
<script src=<?php echo e(asset('dist/js/adminlte.min.js')); ?>></script>
      <!-- AdminLTE App -->
<script src=<?php echo e(asset('plugins/datatables/jquery.dataTables.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/datatables-buttons/js/buttons.html5.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/datatables-buttons/js/buttons.print.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/datatables-buttons/js/buttons.colVis.min.js')); ?>></script>


<script type="text/javascript">
    $(function () {
        tabla = $("#tablaprestadores").DataTable({
            "order": [[ 0, 'desc' ]],
            serverSide: true,
            buttons:true,
            ajax: {
                url:'<?php echo e(route($ajaxroute)); ?>',
                data:{
                        "_token": "<?php echo e(csrf_token()); ?>",
                },
            },
            columns:<?php echo $columnas; ?>,
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

<?php echo $__env->make('layouts/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\GestionLAB\resources\views//proyectospendientes.blade.php ENDPATH**/ ?>