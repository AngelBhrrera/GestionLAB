<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
            ["nombre" => "Diseño"],
            ["nombre" => "Electronica"],
            ["nombre" => "Impresion"],
            ["nombre" => "Investigación"],
            ["nombre" => "Ludica"],
            ["nombre" => "IA"],
            ["nombre" => "Eventos"],
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
