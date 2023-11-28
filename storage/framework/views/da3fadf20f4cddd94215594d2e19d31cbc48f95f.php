<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">


 <!-- Font Awesome -->
 <link rel="stylesheet" href="<?php echo e(asset('plugins/fontawesome-free/css/all.min.css')); ?>">
 <!-- daterange picker -->
 <link rel="stylesheet" href="<?php echo e(asset('plugins/daterangepicker/daterangepicker.css')); ?>">
 <!-- iCheck for checkboxes and radio inputs -->
 <link rel="stylesheet" href="<?php echo e(asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">
 <!-- Tempusdominus Bootstrap 4 -->
 <link rel="stylesheet" href="<?php echo e(asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')); ?>">
 <!-- Select2 -->
 <link rel="stylesheet" href="<?php echo e(asset('plugins/select2/css/select2.min.css')); ?>">
  </head>
<body>
  <!-- Modal -->
  <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Cita de confirmación</h5>



            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="<?php echo e(route('cliente.confirmar_cita')); ?>">
            <?php echo csrf_field(); ?>
          <label >Cita</label>

          <h6 class="modal-title">Horarios del laboratorio: Lunes a Viernes de 9am a 12:30pm y 4:00pm a 7:30pm, Sabado de 9am a 12:30pm </h6>
            <br>
          <h6 class="modal-title">
              La fecha proporcionada aqui es solo una sugerencia,
              por lo que puede ser modificada si no se respeta las horas de servicio del laboratorio o por causas superiores,
               por lo que le pedimos que este al pendiente que su solicitud para la cita sea aprovada en esta pagina y se le dictamine la cita oficial.

          </h6>

          <br>

          <input type="hidden" name="id_cita" id="id_cita">
          <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
            <input type="text" name="fecha_cita" id="fecha_cita" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#reservationdatetime"/>
            <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
          <button type="submit" id="formcita" class="btn btn-primary">Guardar</button>
        </form>
        </div>
      </div>
    </div>
  </div>
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mx auto alert alert-warning" class="row justify-content-center" role="alert">
                        <i class="bi bi-exclamation-triangle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                                <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                                <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
                            </svg></i>

                        <p>Favor de estar al pendiente de esta pagina, ya que por este medio se le informará el status de su impresión. </p>
                        <p>Horarios del laboratorio: Lunes a Viernes de 9am a 12:30pm y 4:00pm a 7:30pm, Sabado de 9am a 12:30pm</p>
                        <br>

                        <p>ATTE: La Administración</p>
                    </div>
                    <div>

                      <div class="card border-secondary">
                        <div class="card-header">
                          <h2>
                            Status de proyectos de impresión 3D
                        </h2>
                        </div>
                        <div class="card-body">
                          <table id="example1"  class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                <?php $__currentLoopData = $datos2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dato2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <th><?php echo e($dato2); ?></th>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <th>cita</th>

                                <th>Información</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php $__currentLoopData = $cita; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $citas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                            <tr style="
                            <?php echo e($citas->status == "cita_pendiente" ? 'background:#EECC25' :''); ?>

                            <?php echo e($citas->status == "solicitud_de_impresion" ? 'background:#EECC25' :''); ?>

                            <?php echo e($citas->status == "cita_aceptada" ? 'background:#9AFF95' :''); ?>

                            <?php echo e($citas->status == "terminado" ? 'background:#9AFF95' :''); ?>

                            ">

                                  <?php $__currentLoopData = $datos2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dato2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                   <td><?php echo e($citas->$dato2); ?></td>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php if(isset($citas->status)): ?>
                                  <td>
                                    <?php if($citas->status == 'solicitud_aceptada'): ?>
                                    <button type="button"
                                      class="btn btn-primary btn-lg"
                                      data-toggle="modal"
                                      data-target="#modelId"
                                      onclick="modalcita('<?php echo e($citas->id_citas); ?>')">

                                      Cita
                                    </button>
                                  <?php endif; ?>
                                <?php endif; ?>
                              </td>

                              <td>

                            <?php if($citas->status == 'solicitud_de_impresion'): ?>
                            Tu petición está en revisión, si se aprueba tu impresión debes agendar la cita aquí, asi que por favor esté al pendiente en este sitio.
                            <?php endif; ?>


                            <?php if($citas->status == 'solicitud_aceptada'): ?>
                            Agenda tu cita en el boton "Cita"
                            <?php endif; ?>

                            <?php if($citas->status == 'cita_pendiente'): ?>
                            Esta fecha solo es una sugerencia, en caso de ser aceptado se tornará el campo verde y el status cambiará a "cita_aceptada" cuando sea la verdadera.
                            <?php endif; ?>

                            <?php if($citas->status == 'cita_aceptada'): ?>
                            Tu cita ya ha sido agendada, favor de ir en la fecha establecida al Laboratorio de Inventores "<?php echo e($citas->fechacita); ?>".
                            <?php endif; ?>

                            <?php if($citas->status == 'impresion_marcha' || $citas->status == 'impresion_terminar'): ?>
                            Tu impresión está en proceso.
                            <?php endif; ?>

                            <?php if($citas->status == 'terminado'): ?>
                            Ya puedes recoger tu impresión 3D en el Laboratorio de Inventores, se te dará una hoja de conformidad que tendras que llenar, consulta el horario
                            "Horarios del laboratorio: Lunes a Viernes de 9am a 12:30pm y 4:00pm a 7:30pm, Sabado de 9am a 12:30pm".
                            <?php endif; ?>

                              </td>
                              </tr>

                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                          </table>
                        </div>
                      </div>

                    </div>


        </div>
    </div>
</div>


<!-- Bootstrap 4 -->

<!-- AdminLTE App -->
<script src=<?php echo e(asset('dist/js/adminlte.min.js')); ?>></script>
<!-- Bootstrap 4 -->
<!-- DataTables  & Plugins -->
<script src=<?php echo e(asset('plugins/datatables/jquery.dataTables.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/jszip/jszip.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/pdfmake/pdfmake.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/pdfmake/vfs_fonts.js')); ?>></script>
<script src=<?php echo e(asset('plugins/datatables-buttons/js/buttons.html5.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/datatables-buttons/js/buttons.print.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/datatables-buttons/js/buttons.colVis.min.js')); ?>></script>
<script src=<?php echo e(asset('plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>></script>
<script src=<?php echo e(asset('dist/js/adminlte.min.js')); ?>></script>
<script src="<?php echo e(asset('plugins/select2/js/select2.full.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/moment/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/inputmask/jquery.inputmask.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/daterangepicker/daterangepicker.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')); ?>"></script>
      <script type="text/javascript">

function modalcita(id){
    $('#modelId').modal({
        keyboard: true,
        backdrop: "static",
        show:false,
    })
    document.getElementById("id_cita").value = id;


  }
        $(function () {
              $("#example1").DataTable({
                "pageLength": 9,
                "ordering": false,
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": [
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


              }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            });



        </script>
        <script type="text/javascript">
          $(function () {
              $('#timepicker').datetimepicker({
              format: 'L',

              })
              $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' },
                minDate:new Date(),
                daysOfWeekDisabled: [0],
                format: 'DD/MM/YYYY HH:mm',
                disabledHours: [0, 1, 2, 3, 4, 5, 6, 7, 8, 14, 15, 21, 22, 23]});
          });

          </script>
</body>
</html>
<?php /**PATH C:\laragon\www\GestionSSCFE\resources\views/principal_clientes.blade.php ENDPATH**/ ?>