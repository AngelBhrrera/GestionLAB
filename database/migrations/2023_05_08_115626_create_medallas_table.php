<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedallasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medallas', function (Blueprint $table) {
            $table->bigIncrements('nivel');
            $table->string('ruta');
            $table->string('descripcion');
            $table->foreign('nivel')->references('nivel')->on('niveles');
        });
        
        DB::table('medallas')->insert([
            [
                'nivel' => 1,
                'ruta' => 'img/Medallas/Roca.webp',
                'descripcion' => 'Medalla de roca',
            ],
            [
                'nivel' => 2,
                'ruta' => 'img/Medallas/Cascada.webp',
                'descripcion' => 'Medalla Cascada',
            ],
            [
                'nivel' => 3,
                'ruta' => 'img/Medallas/Trueno.webp',
                'descripcion' => 'Medalla Trueno',
            ],
            [
                'nivel' => 4,
                'ruta' => 'img/Medallas/Arcoiris.webp',
                'descripcion' => 'Medalla Arcoiris',
            ],
            [
                'nivel' => 5,
                'ruta' => 'img/Medallas/Volcan.webp',
                'descripcion' => 'Medalla Volcan',
            ],
            [
                'nivel' => 6,
                'ruta' => 'img/Medallas/Tierra.webp',
                'descripcion' => 'Medalla Tierra',
            ],
            [
                'nivel' => 7,
                'ruta' => 'img/Medallas/Cefiro.webp',
                'descripcion' => 'Medalla Céfiro',
            ],
            [
                'nivel' => 8,
                'ruta' => 'img/Medallas/Glaciar.webp',
                'descripcion' => 'Medalla Glaciar',
            ],
            [
                'nivel' => 9,
                'ruta' => 'img/Medallas/Dragon.webp',
                'descripcion' => 'Medalla Dragón',
            ],
            [
                'nivel' => 10,
                'ruta' => 'img/Medallas/Piedra.webp',
                'descripcion' => 'Medalla Piedra',
            ],
            [
                'nivel' => 11,
                'ruta' => 'img/Medallas/Puño.webp',
                'descripcion' => 'Medalla Puño',
            ],
            [
                'nivel' => 12,
                'ruta' => 'img/Medallas/Dinamo.webp',
                'descripcion' => 'Medalla Dinamo',
            ],
            [
                'nivel' => 13,
                'ruta' => 'img/Medallas/Calor.webp',
                'descripcion' => 'Medalla Calor',
            ],
            [
                'nivel' => 14,
                'ruta' => 'img/Medallas/Pluma.webp',
                'descripcion' => 'Medalla Pluma',
            ],
            [
                'nivel' => 15,
                'ruta' => 'img/Medallas/Mente.webp',
                'descripcion' => 'Medalla Mente',
            ],
            [
                'nivel' => 16,
                'ruta' => 'img/Medallas/Lluvia.webp',
                'descripcion' => 'Medalla Lluvia',
            ],
            [
                'nivel' => 17,
                'ruta' => 'img/Medallas/Lignito.webp',
                'descripcion' => 'Medalla Lignito',
            ],
            [
                'nivel' => 18,
                'ruta' => 'img/Medallas/Bosque.webp',
                'descripcion' => 'Medalla Bosque',
            ],
            [
                'nivel' => 19,
                'ruta' => 'img/Medallas/Adoquin.webp',
                'descripcion' => 'Medalla Adoquín',
            ],
            [
                'nivel' => 20,
                'ruta' => 'img/Medallas/Cienaga.webp',
                'descripcion' => 'Medalla Ciénaga',
            ],
            [
                'nivel' => 21,
                'ruta' => 'img/Medallas/Reliquia.webp',
                'descripcion' => 'Medalla Reliquia',
            ],
            [
                'nivel' => 22,
                'ruta' => 'img/Medallas/Mina.webp',
                'descripcion' => 'Medalla Mina',
            ],
            [
                'nivel' => 23,
                'ruta' => 'img/Medallas/Carambano.webp',
                'descripcion' => 'Medalla Carámbano',
            ],
            [
                'nivel' => 24,
                'ruta' => 'img/Medallas/Faro.webp',
                'descripcion' => 'Medalla Faro',
            ],
            [
                'nivel' => 25,
                'ruta' => 'img/Medallas/Trio.webp',
                'descripcion' => 'Medalla Trío',
            ],
            [
                'nivel' => 26,
                'ruta' => 'img/Medallas/Elitro.webp',
                'descripcion' => 'Medalla Élitro',
            ],
            [
                'nivel' => 27,
                'ruta' => 'img/Medallas/Voltio.webp',
                'descripcion' => 'Medalla Voltio',
            ],
            [
                'nivel' => 28,
                'ruta' => 'img/Medallas/Temblor.webp',
                'descripcion' => 'Medalla Temblor',
            ],
            [
                'nivel' => 29,
                'ruta' => 'img/Medallas/Jet.webp',
                'descripcion' => 'Medalla Jet',
            ],
            [
                'nivel' => 30,
                'ruta' => 'img/Medallas/Candelizo.webp',
                'descripcion' => 'Medalla Candelizo',
            ],
            [
                'nivel' => 31,
                'ruta' => 'img/Medallas/Ola.webp',
                'descripcion' => 'Medalla Ola',
            ],
            [
                'nivel' => 32,
                'ruta' => 'img/Medallas/Hoja.webp',
                'descripcion' => 'Medalla Hoja',
            ],
            [
                'nivel' => 33,
                'ruta' => 'img/Medallas/Psique.webp',
                'descripcion' => 'Medalla Psique',
            ],
            [
                'nivel' => 34,
                'ruta' => 'img/Medallas/Iceberg.webp',
                'descripcion' => 'Medalla Iceberg',
            ],
            [
                'nivel' => 35,
                'ruta' => 'img/Medallas/Leyenda.webp',
                'descripcion' => 'Medalla Leyenda',
            ],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('medallas');
    }
}
