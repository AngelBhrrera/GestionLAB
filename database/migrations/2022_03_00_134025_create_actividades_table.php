<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categoria_id');
            $table->string('nombre', 255)->collation('utf8mb4_unicode_ci');
            $table->time('horas');

            $table->foreign('categoria_id')->references('id')->on('categorias')->onUpdate('cascade')->onDelete('cascade');
        });

        DB::table('actividades')->insert([
            ["categoria_id" => 1,
             'nombre' => "Desarrollo de videojuegos",
            'horas' => '200:00:00'],
            ["categoria_id" => 1,
             'nombre' => "Desarrollo Web",
            'horas' => '04:00:00'],
            ["categoria_id" => 1,
             'nombre' => "Desarrollo Movil",
            'horas' => '03:00:00'],
            ["categoria_id" => 4,
             'nombre' => "Diseño de Logotipos",
            'horas' => '04:00:00'],
            ["categoria_id" => 4,
             'nombre' => "Diseño de Interfaces",
            'horas' => '05:00:00'],
            ["categoria_id" => 2,
             'nombre' => "Gestion de Proyectos",
            'horas' => '05:00:00'],
            ["categoria_id" => 2,
             'nombre' => "Contabilidad",
            'horas' => '03:00:00'],
            ["categoria_id" => 5,
             'nombre' => "Relacionado a Drones",
            'horas' => '20:00:00'],
            ["categoria_id" => 3,
             'nombre' => "Mantenimiento Impresora Resina",
            'horas' => '02:00:00'],
            ["categoria_id" => 3,
             'nombre' => "Mantenimiento Impresora Filamento",
            'horas' => '02:00:00'],
            ["categoria_id" => 3,
             'nombre' => "Mantenimiento Equipos de Computo",
            'horas' => '02:00:00'],
            ["categoria_id" => 3,
             'nombre' => "Mantenimiento Electrodomesticos",
            'horas' => '02:00:00'],
            ["categoria_id" => 6,
             'nombre' => "Modelado 3D",
            'horas' => '02:00:00'],
            ["categoria_id" => 6,
             'nombre' => "Impresion Proyecto Interno",
            'horas' => '08:00:00'],
            ["categoria_id" => 6,
             'nombre' => "Impresion Externo",
            'horas' => '04:00:00'],

        ]);
    }


    public function down()
    {
        Schema::dropIfExists('actividades');
    }
}
