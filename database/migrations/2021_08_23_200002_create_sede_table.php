<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSedeTable extends Migration
{
    protected $table =  'sede';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sede', function (Blueprint $table) {
            $table->id('id_Sede');
            $table->string('nombre_Sede')->length(150);
            $table->integer('turnoMatutino')->length(10);
            $table->integer('turnoMediodia')->length(10);
            $table->integer('turnoVespertino')->length(10);
            $table->integer('turnoSabatino')->length(10);
            $table->integer('turnoTiempoCompleto')->length(10);
            $table->integer('no_Aplica')->length(10);
            $table->boolean('activa')->default(1);
            $table->boolean('servicios_impresion')->default(0);

        });

            DB::table('sede')->insert([
                "nombre_Sede" => "Inventores CUCEI",
                'turnoMatutino'=> 1,
                'turnoMediodia'=> 1,
                'turnoVespertino'=> 1,
                'turnoSabatino'=> 1,
                'turnoTiempoCompleto'=> 1,
                'no_Aplica'=> 1,
            ]);
            DB::table('sede')->insert([
                "nombre_Sede" => "CORCOM",
                'turnoMatutino'=> 1,
                'turnoMediodia'=> 1,
                'turnoVespertino'=> 1,
                'turnoSabatino'=> 0,
                'turnoTiempoCompleto'=> 0,
                'no_Aplica'=> 1,
            ]);
            DB::table('sede')->insert([
                "nombre_Sede" => "CUCEI Innovación",
                'turnoMatutino'=> 1,
                'turnoMediodia'=> 1,
                'turnoVespertino'=> 1,
                'turnoSabatino'=> 1,
                'turnoTiempoCompleto'=> 1,
                'no_Aplica'=> 0,
            ]);
            DB::table('sede')->insert([
                "nombre_Sede" => "CFE",
                'turnoMatutino'=> 0,
                'turnoMediodia'=> 0,
                'turnoVespertino'=> 0,
                'turnoSabatino'=> 1,
                'turnoTiempoCompleto'=> 1,
                'no_Aplica'=> 1,
            ]);
            DB::table('sede')->insert([
                "nombre_Sede" => "CUCS",
                'turnoMatutino'=> 1,
                'turnoMediodia'=> 1,
                'turnoVespertino'=> 1,
                'turnoSabatino'=> 1,
                'turnoTiempoCompleto'=> 1,
                'no_Aplica'=> 1,
            ]);
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sede');
    }
}
