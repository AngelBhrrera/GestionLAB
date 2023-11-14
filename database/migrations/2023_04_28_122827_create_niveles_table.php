<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNivelesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('niveles', function (Blueprint $table) {
            // $table->id();
            // $table->integer('nivel');
            $table->bigIncrements('nivel');
            $table->integer('experiencia');
            $table->integer('experiencia_acumulada');
            $table->string('nombre_insignia')->nullable()->default(null);
        });

        DB::table('niveles')->insert([
            ['nivel' => 1, 'experiencia' => 100, 'experiencia_acumulada' => 100],
            ['nivel' => 2, 'experiencia' => 178, 'experiencia_acumulada' => 278],
            ['nivel' => 3, 'experiencia' => 276, 'experiencia_acumulada' => 554],
            ['nivel' => 4, 'experiencia' => 388, 'experiencia_acumulada' => 942],
            ['nivel' => 5, 'experiencia' => 509, 'experiencia_acumulada' => 1451],
            ['nivel' => 6, 'experiencia' => 633, 'experiencia_acumulada' => 2084],
            ['nivel' => 7, 'experiencia' => 760, 'experiencia_acumulada' => 2844],
            ['nivel' => 8, 'experiencia' => 891, 'experiencia_acumulada' => 3735],
            ['nivel' => 9, 'experiencia' => 1025, 'experiencia_acumulada' => 4760],
            ['nivel' => 10, 'experiencia' => 1142, 'experiencia_acumulada' => 5902],
            ['nivel' => 11, 'experiencia' => 1303, 'experiencia_acumulada' => 7205],
            ['nivel' => 12, 'experiencia' => 1420, 'experiencia_acumulada' => 8625],
            ['nivel' => 13, 'experiencia' => 1523, 'experiencia_acumulada' => 10148],
            ['nivel' => 14, 'experiencia' => 1670, 'experiencia_acumulada' => 11818],
            ['nivel' => 15, 'experiencia' => 1725, 'experiencia_acumulada' => 13543],
            ['nivel' => 16, 'experiencia' => 1890, 'experiencia_acumulada' => 15433],
            ['nivel' => 17, 'experiencia' => 1994, 'experiencia_acumulada' => 17427],
            ['nivel' => 18, 'experiencia' => 2095, 'experiencia_acumulada' => 19522],
            ['nivel' => 19, 'experiencia' => 2192, 'experiencia_acumulada' => 21714],
            ['nivel' => 20, 'experiencia' => 2286, 'experiencia_acumulada' => 24000],
            ['nivel' => 21, 'experiencia' => 2336, 'experiencia_acumulada' => 26336],
            ['nivel' => 22, 'experiencia' => 2386, 'experiencia_acumulada' => 28722],
            ['nivel' => 23, 'experiencia' => 2436, 'experiencia_acumulada' => 31158],
            ['nivel' => 24, 'experiencia' => 2486, 'experiencia_acumulada' => 33644],
            ['nivel' => 25, 'experiencia' => 2536, 'experiencia_acumulada' => 36180],
            ['nivel' => 26, 'experiencia' => 2586, 'experiencia_acumulada' => 38766],
            ['nivel' => 27, 'experiencia' => 2636, 'experiencia_acumulada' => 41402],
            ['nivel' => 28, 'experiencia' => 2686, 'experiencia_acumulada' => 44088],
            ['nivel' => 29, 'experiencia' => 2736, 'experiencia_acumulada' => 46824],
            ['nivel' => 30, 'experiencia' => 2786, 'experiencia_acumulada' => 49610],
            ['nivel' => 31, 'experiencia' => 2836, 'experiencia_acumulada' => 52446],
            ['nivel' => 32, 'experiencia' => 2886, 'experiencia_acumulada' => 55332],
            ['nivel' => 33, 'experiencia' => 2936, 'experiencia_acumulada' => 58268],
            ['nivel' => 34, 'experiencia' => 2986, 'experiencia_acumulada' => 61254],
            ['nivel' => 35, 'experiencia' => 3036, 'experiencia_acumulada' => 64290]
        ]);
    }

    public function down()
        {
            Schema::dropIfExists('niveles');
        }

}


