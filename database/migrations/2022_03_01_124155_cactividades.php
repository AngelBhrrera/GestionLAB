<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cactividades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_actividad', function (Blueprint $table) {
            $table->bigIncrements('id_actividad');
            $table->string('nombre_act', 50);
            $table->string('tipo_act', 50)->default('otro');
            $table->integer('id_prestador')->nullable();
            $table->unsignedBigInteger('acti_id')->nullable();
            $table->text('descripcion')->nullable();
            $table->text('objetivo');
            $table->string('fecha', 50);
            $table->string('status', 50)->default('en proceso');
            $table->string('llave_actividad', 100)->nullable();
            $table->string('fecha_realizada', 60)->nullable();
            $table->string('imagen', 2000)->nullable();
            $table->string('archivo', 2000)->nullable();
            $table->bigInteger('encargado_id')->unsigned()->nullable();
            $table->bigInteger('creacion_id')->unsigned()->nullable();
            $table->time('estimacion_tiempo')->nullable();
            $table->integer('asignado_a')->nullable();
            $table->string('nota_error', 255)->nullable();
            $table->dateTime('fecha_inicio')->nullable();
            $table->dateTime('fecha_fin')->nullable();
            $table->time('duracion')->nullable();
            $table->integer('experiencia_obtenida')->nullable();
            $table->timestamps();
            $table->index('acti_id');
            $table->foreign('acti_id')
                  ->references('id')
                  ->on('actividades')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('c_actividad');
    }
}
