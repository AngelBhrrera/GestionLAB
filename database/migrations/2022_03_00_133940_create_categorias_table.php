<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255)->collation('utf8mb4_unicode_ci');
        });

        DB::table('categorias')->insert([
            ["nombre" => "Programacion"],
            ["nombre" => "Administracion"],
            ["nombre" => "Mantenimiento"],
            ["nombre" => "Diseño Gráfico"],
            ["nombre" => "Robotica"],
            ["nombre" => "Impresion 3D"],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorias');
    }
}
