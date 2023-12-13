<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitas', function (Blueprint $table) {
            
            $table->id();
            $table->string('name', 100);
            $table->string('apellido', 100);
            $table->string('correo', 100);
            $table->string('numero', 20);
            $table->string('fecha', 20);
            $table->string('hora_llegada',20);
            $table->string('hora_salida',20)->nullable();
            $table->string('motivo', 255)->nullable();
            $table->string('responsable_id');
            $table->string('responsable', 100);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitas');
    }
}
