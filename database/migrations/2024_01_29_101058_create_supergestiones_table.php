<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupergestionesTable extends Migration
{

    public function up()
    {
        Schema::create('supergestiones', function (Blueprint $table) {
            
            $table->id();

            $table->boolean('torneo')->default(0);
            $table->boolean('impresiones')->default(0);
            $table->boolean('visitas')->default(0);
            $table->boolean('reportes')->default(0);
           
        });
    }

    public function down()
    {
        Schema::dropIfExists('supergestiones');
    }
}
