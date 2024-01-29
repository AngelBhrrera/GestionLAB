<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadesTable extends Migration
{

    public function up()
    {
        Schema::create('actividades', function (Blueprint $table) {

            $table->id();
            $table->string('titulo', 255)->collation('utf8mb4_unicode_ci');
            $table->unsignedBigInteger('id_categoria');
            $table->foreign('id_categoria')->references('id')->on('categorias')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_subcategoria')->nullable();
            $table->integer('TEC');
            $table->string('tipo', 10)->default('generica');
            $table->string('recursos', 500);
            $table->string('descripcion', 500);
            
        });

    }


    public function down()
    {
        Schema::dropIfExists('actividades');
    }
}
