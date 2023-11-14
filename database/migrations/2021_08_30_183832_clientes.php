<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Clientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->integer('id',0,0);
            $table->string('codigo',50)->nullable();
            $table->string('nombre',50);
            $table->string('fecha',50)->nullable();
            $table->string('hora_entrada',50)->nullable();
            $table->string('hora_salida',50)->nullable();
            $table->string('tiempo',50)->nullable();
            $table->string('visitas',50)->default('no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
