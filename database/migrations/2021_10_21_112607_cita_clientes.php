<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CitaClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cita_clientes', function (Blueprint $table) {
            $table->id('id_citas');
            $table->integer('id',0,0)->nullable();
            $table->string('correo',100);
            $table->string('nombre',100);
            $table->string('telefono',20);
            $table->string('carrera',100);
            $table->integer('semestre',0,0);
            // $table->text('credencial')->nullable();
            $table->text('enlaceDrive')->nullable();
            $table->string('proyecto',100);
            // $table->text('render')->nullable();
            // $table->text('ArchivoSTL')->nullable();
            $table->integer('N_piezas',0,0)->default((1));
            $table->text('observaciones');
            $table->timestamp('fecha')->useCurrent();
            $table->string('status',25)->default('solicitud_de_impresion');
            $table->text('palabrasClave');
            $table->text('introduccion');
            $table->text('trabajosRelacionados');
            $table->text('propuesta');
            $table->text('conclusion');
            $table->string('fechacita', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cita_clientes');
    }
}
