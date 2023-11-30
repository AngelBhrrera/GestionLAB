<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaltasTable extends Migration
{
    public function up()
    {
        Schema::create('faltas', function (Blueprint $table) {
            $table->bigInteger('id_usuario');
            $table->string('fecha', 100)->nullable(false);
            $table->string('nombre', 100)->nullable();
            $table->string('apellido', 100)->nullable();
            $table->string('correo', 100)->nullable();
            $table->integer('id')->nullable(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('faltas');
    }
}
