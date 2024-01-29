<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCumpleaniosTable extends Migration
{

    public function up()
    {
        Schema::create('cumpleanios', function (Blueprint $table) {
            $table->id();
            $table->integer('id_Prestador');
            $table->string('fecha', 10);
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('cumpleanios');
    }
}

