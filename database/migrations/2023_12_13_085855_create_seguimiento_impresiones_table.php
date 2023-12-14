<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSeguimientoImpresionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seguimiento_impresiones', function (Blueprint $table) {
            $table->id();
            $table->integer("id_Prestador");
            $table->integer("id_Impresora");
            $table->integer("id_Proyecto")->nullable();
            $table->dateTime("fecha")->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string("nombre_modelo_stl", 100);
            $table->string("tiempo_impresion", 10);
            $table->string("color", 50);
            $table->integer("piezas");
            $table->boolean("prioridad")->default(0);
            $table->string("estado", 50)->default("En Proceso");
            $table->float("peso");
            $table->string("observaciones", 500)->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seguimiento_impresiones');
    }
}
