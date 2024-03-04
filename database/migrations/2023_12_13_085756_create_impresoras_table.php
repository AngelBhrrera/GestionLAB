<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImpresorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('impresoras', function (Blueprint $table) {
            $table->id();
            $table->string("nombre", 100);
            $table->string("marca", 100);
            $table->string("tipo", 100);
            $table->boolean("estado")->default(1);
            $table->dateTime("ultimo_uso")->nullable();
            $table->dateTime("ultimo_mantenimiento")->nullable();
            $table->integer("id_area");
            $table->integer("act_impresion")->nullable();
            $table->integer("act_mantenimiento")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('impresoras');
    }
}
