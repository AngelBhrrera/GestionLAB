<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportesSSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reportes_s_s', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_prestador');
            $table->string('nombre_reporte');
            $table->string('tipo');
            $table->date('fecha_subida');
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
        Schema::dropIfExists('reportes_s_s');
    }
}
