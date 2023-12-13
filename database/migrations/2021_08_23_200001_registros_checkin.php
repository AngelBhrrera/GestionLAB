<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class RegistrosCheckIn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('registros_checkin', function (Blueprint $table) {
            $table->id();
            $table->string('codigo',50);
            $table->string('nombre',50);
            $table->string('apellido',50);
            $table->string('fecha',50);
            $table->string('hora_entrada',50);
            
            $table->string('hora_salida',50)->nullable();
            $table->string('tiempo',50)->nullable();
            $table->string('estado',50)->default('pendiente');
            $table->integer('horas',0,0)->nullable();

            $table->string('nota',255)->default('');

            $table->binary('pdf')->nullable();

            $table->timestamp('fecha_actual')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('idusuario',0,0)->nullable();
            $table->string('origen',50)->default('');
            $table->string('responsable',50)->nullable();
            $table->string('tipo',50);
            $table->string('srcimagen',1000)->default('')->nullable();
            $table->bigInteger('encargado_id')->unsigned()->nullable()->default(null);
        });



    }

    public function down()
    {
        Schema::dropIfExists('registros_checkin');
    }
}
