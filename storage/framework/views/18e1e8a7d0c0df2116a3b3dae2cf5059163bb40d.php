<!DOCTYPE html>
<head>
    <link rel="icon" href="<?php echo e(asset('img/recursos/logo-bowser.ico')); ?>"/>

</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e($nombre); ?></div>
                <div class="card-body">
                    <form method="POST" action="<?php echo e(isset($ruta) ?  route($ruta) :route('registrar')); ?>">
                        <input id="id" name="id" type="hidden" value="<?php echo e(!isset($dV[0]->id) ? old('id') : $dV[0]->id); ?>">
                        <input  name="TipoOriginal" type="hidden" value="<?php echo e(isset($dV[0]->tipo) ? $dV[0]->tipo : old('TipoOriginal')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="form-check row">
                            <input type="checkbox" style="opacity:0; position:absolute;" class="form-check-input" type="hidden" id="alumnoCheck" name="alumnoCheck" value="1" onchange="caseAlumno()" >
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Nombre')); ?></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name" value="<?php echo e(isset($dV[0]->name) ? $dV[0]->name : old('name')); ?>"  autocomplete="name" autofocus>
                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="apellido" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Apellido')); ?></label>

                            <div class="col-md-6">
                                <input id="apellido" type="text" class="form-control <?php $__errorArgs = ['apellido'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="apellido" value="<?php echo e(isset($dV[0]->apellido) ? $dV[0]->apellido : old('apellido')); ?>"  autocomplete="apellido" autofocus>

                                <?php $__errorArgs = ['apellido'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label  class="col-md-4 col-form-label text-md-right"><?php echo e(__('Correo')); ?></label>

                            <div class="col-md-6">
                                <input id="correo" type="email" class="form-control  <?php $__errorArgs = ['correo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> "  name="correo" value="<?php echo e(isset($dV[0]->correo) ? $dV[0]->correo : old('correo')); ?>" >
                                <?php $__errorArgs = ['correo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>



                            </div>
                        </div>

                        <div class="form-group row">
                            <label  class="col-md-4 col-form-label text-md-right"><?php echo e(__('Tipo de usuario')); ?></label>
                            <div class="col-md-6">
                                <select  class="form-control" name="tipo" id="tipo" onchange="cambiarRB()">

                                    <option id="RBcliente" value='clientes' <?php echo e((old('tipo',isset($dV[0]->tipo) ? $dV[0]->tipo : '') == "clientes") ? "selected" : ''); ?>>Visitante</option>

                                    <option id="RBprestador" value='prestador' <?php echo e(old('tipo', isset($dV[0]->tipo) ? $dV[0]->tipo : '') == "prestador" ? "selected": ''); ?>>Prestador</option>
                                    <option id="RBadmin" value='admin' <?php echo e(old('tipo',isset($dV[0]->tipo) ? $dV[0]->tipo : '') == "admin" ? "selected": ''); ?>>Administrador</option>

                                </select>

                             </div>
                        </div>
                        <div id="divcaseVisitante" style="display: none">
                            <div class="form-group row">

                                <label  class="col-md-4 col-form-label text-md-right"><?php echo e(__('Tipo de visitante')); ?></label>
                                <div class="col-md-6">
                                    <select  class="form-control" name="tipo_cliente" id="tipoV" onchange="cambiarRB()">

                                        <option id="RBCAlumno" value='Alumno' <?php echo e((old('tipo_cliente',isset($dV[0]->tipo_cliente) ? $dV[0]->tipo_cliente : '') == "Alumno") ? "selected" : ''); ?>>Alumno</option>

                                        <option id="RBCMaistro" value='Maestro' <?php echo e((old('tipo_cliente',isset($dV[0]->tipo_cliente) ? $dV[0]->tipo_cliente : '') == "Maestro") ? "selected" : ''); ?>>Maestro</option>
                                        <option id="RBCOtro" value='Otro' <?php echo e((old('tipo_cliente',isset($dV[0]->tipo_cliente) ? $dV[0]->tipo_cliente : '') == "Otro") ? "selected" : ''); ?>>Otro</option>

                                    </select>

                                 </div>
                            </div>
                        </div>

                        <div id="divAlumno" >
                            <div class="form-group row">
                                <label  class="col-md-4 col-form-label text-md-right"><?php echo e(__('Codigo')); ?></label>

                                <div class="col-md-6">
                                    <input id="codigo"  class="form-control  <?php $__errorArgs = ['codigo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> " name="codigo" value="<?php echo e(isset($dV[0]->codigo) ? $dV[0]->codigo : old('codigo')); ?>" >

                                    <?php $__errorArgs = ['codigo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>


                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-md-4 col-form-label text-md-right"><?php echo e(__('Centro')); ?></label>

                                <div class="col-md-6">
                                    <select class="form-control <?php $__errorArgs = ['centro'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="centro" id="centro" >
                                    <option selected id="1" value='null'>Seleccione un centro</option>
                                                <option id="1" value='CUCEI'>CUCEI</option>
                                                <option id="2" value='CUAAD'>CUAAD</option>
                                                <option id="3" value='CUCEA'>CUCEA</option>
                                                <option id="4" value='CUCBA' >CUCBA</option>
                                                <option id="5" value='CUCSH'>CUCSH</option>                    
                                                <option id="6" value='CUCS' >CUCS</option>
                                                <option id="7" value='CUNORTE' >CUNORTE</option>
                                                <option id="8" value='CULAGOS'>CULAGOS</option>                    
                                                <option id="9" value='CUVALLE' >CUVALLE</option>
                                                <option id="10" value='CUALTOS' >CUALTOS</option>
                                                <option id="11" value='CUCOSTA'>CUCOSTA</option>                    
                                                <option id="12" value='CUCOSTA' >CUTONALA</option>
                                                <option id="13" value='CUCIENEGA' >CUCIENEGA</option>
                                                <option id="14" value='CUCSUR'>CUCSUR</option>                    
                                                <option id="15" value='CUSUR' >CUSUR</option>
                                            </select>
                                            <?php if(old('opc')=='1'): ?>
                                                <?php $__errorArgs = ['centro'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($message); ?></strong>
                                                    </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            <?php endif; ?>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="carrera" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Carrera')); ?></label>

                                <div class="col-md-6">
                                    <input id="carrera" type="text" class="form-control <?php $__errorArgs = ['carrera'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="carrera" value="<?php echo e(isset($dV[0]->carrera) ? $dV[0]->carrera : old('carrera')); ?>"  autocomplete="carrera">
                                    <?php $__errorArgs = ['carrera'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="telefono" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Telefono')); ?></label>

                                <div class="col-md-6">
                                    <input id="telefono" type="text" class="form-control <?php $__errorArgs = ['telefono'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="telefono" value="<?php echo e(isset($dV[0]->telefono) ? $dV[0]->telefono : old('telefono')); ?>"  autocomplete="telefono">
                                    <?php $__errorArgs = ['telefono'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            
                            <div class="form-group row">
                                <label  class="col-md-4 col-form-label text-md-right"><?php echo e(__('Puede ser admin')); ?></label>

                                <div class="col-md-6">
                                    <select class="form-control <?php $__errorArgs = ['can_admin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="can_admin" id="can_admin" >
                                        <option value="0" <?php echo e((old('can_admin',isset($dV[0]->can_admin) ? $dV[0]->can_admin : '') == 0) ? "selected" : ''); ?>>No</option>
                                        <option value="1" <?php echo e((old('can_admin',isset($dV[0]->can_admin) ? $dV[0]->can_admin : '') == 1) ? "selected" : ''); ?>>Si</option>
                                    </select>
                                    <?php $__errorArgs = ['can_admin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                </div>

                            </div>

                            <div class="form-group row">
                                <label  class="col-md-4 col-form-label text-md-right"><?php echo e(__('Encargado')); ?></label>

                                <div class="col-md-6">
                                    <select class="form-control <?php if(old('opc')=='1'): ?> <?php $__errorArgs = ['encargado_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> <?php endif; ?>" name="encargado_id" id="encargado_id">
                                        <?php if(isset($encargado)): ?>
                                        <option id="encargadonull" value="<?php echo e(null); ?>" <?php echo e(isset($dV[0]->encargado_id) ? $dV[0]->encargado_id == null ? 'selected="selected"' : '' : ''); ?>></option>
                                        <?php $__currentLoopData = $encargado; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dato): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option id="<?php echo e($dato->id); ?>" value="<?php echo e($dato->id); ?>" <?php echo e(old('encargado_id', $dV[0]->encargado_id) == $dato->id ? 'selected="selected"' : ''); ?>>
                                                    <?php echo e($dato->name); ?> <?php echo e($dato->apellido); ?>

                                                </option>                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                    <?php if(old('opc')=='1'): ?>
                                    <?php $__errorArgs = ['encargado'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <?php endif; ?>

                                </div>
                            </div>

                        </div>
                        <div id="divhoras" class="form-group row" style="display: none">
                            <label  class="col-md-4 col-form-label text-md-right"><?php echo e(__('Horas')); ?></label>

                            <div class="col-md-6">
                                <input id="horas" type="number" class="form-control <?php $__errorArgs = ['horas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> " name="horas" value="<?php echo e(isset($dV[0]->horas) ? $dV[0]->horas : old('horas')); ?>" >
                                <?php $__errorArgs = ['horas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            </div>
                        </div>

                        <?php if(@isset($nombre)): ?>

                            <?php if($nombre != 'Modificar'): ?>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Contraseña')); ?></label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password"  autocomplete="new-password">

                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Confirmar Contraseña')); ?></label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                                </div>
                            </div>
                            <?php endif; ?>

                        <?php endif; ?>

                <button type="submit" class="btn btn-lg btn-block btn-primary"><?php echo e(__('Registrar')); ?></button>
            </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src=<?php echo e(asset('plugins/jquery/jquery.min.js')); ?>></script>
<!-- Bootstrap 4 -->
<script src=<?php echo e(asset('plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>></script>
<!-- AdminLTE App -->
<script src=<?php echo e(asset('dist/js/adminlte.min.js')); ?>></script>
<script type="text/javascript">
$(document).ready(function(){
    caseAlumno();
    cambiarRB();
});
function caseAlumno(){
    var divalumno = document.getElementById('divAlumno');
    var horas = document.getElementById('horas');

    if(document.getElementById('alumnoCheck').checked ){
        divalumno.style.display = "";

        document.getElementById('codigo').value = "<?php echo e(isset($dV[0]->codigo) ? $dV[0]->codigo : ''); ?>";
    }else{
        divalumno.style.display = "none";


    }
}
function cambiarRB(){
    var divhoras = document.getElementById('divhoras');
    var horas = document.getElementById('horas');
    var caseV = document.getElementById('divcaseVisitante');
    var caseVOtro = document.getElementById('RBCOtro');
    var divalumno = document.getElementById('divAlumno');
    if(document.getElementById('RBprestador').selected) {
        document.getElementById("alumnoCheck").checked = true;
        divhoras.style.display = "";
        caseV.style.display = 'none';
        caseAlumno();
      }else {
        divhoras.style.display = "none";
        caseV.style.display = '';
        horas.value = null;

        if(caseVOtro.selected){
            divalumno.style.display = "none";

        }else{
            divalumno.style.display = "";

        }
      }
      if(document.getElementById('RBCAlumno').selected){
        document.getElementById('alumnoCheck').checked = 'checked';
      }
      if(document.getElementById('RBCMaistro').selected){
        document.getElementById('alumnoCheck').checked = 'checked';
      }
      if(document.getElementById('RBadmin').selected){
        divalumno.style.display = "none";
        caseV.style.display = 'none';

      }
}
</script>


<!-- Bootstrap 4 -->
<!-- DataTables  & Plugins -->



</html>


<?php /**PATH C:\laragon\www\GestionLAB\resources\views/auth/registerAdmin.blade.php ENDPATH**/ ?>