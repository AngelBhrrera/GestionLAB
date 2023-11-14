<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSedeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sede', function (Blueprint $table) {
            $table->id('id_Sede');
            $table->string('nombre_Sede', 150);

            DB::table('sede')->insert([
                "nombre_Sede" => "CUCEI Laboratorio"
            ]);
            DB::table('sede')->insert([
                "nombre_Sede" => "CUCEI Coordinación"
            ]);
            DB::table('sede')->insert([
                "nombre_Sede" => "CUCEI Innovación"
            ]);
            DB::table('sede')->insert([
                "nombre_Sede" => "CFE"
            ]);
            DB::table('sede')->insert([
                "nombre_Sede" => "CUCS"
            ]);
        });
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
