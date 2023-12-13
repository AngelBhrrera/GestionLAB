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
            $table->string('nombre', 255)->collation('utf8mb4_unicode_ci');
            $table->unsignedBigInteger('id_categoria');
            $table->foreign('id_categoria')->references('id')->on('categorias')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('TEC');
            $table->string('descripcion', 500)->collation('utf8mb4_unicode_ci');
            
        });

    }


    public function down()
    {
        Schema::dropIfExists('actividades');
    }
}
