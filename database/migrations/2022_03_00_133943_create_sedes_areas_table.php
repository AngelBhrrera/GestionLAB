<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSedesAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sedes_areas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_sede');
            $table->integer('id_area');
        });

        DB::table('sedes_areas')->insert([
            ['id_sede' => 1, 'id_area' => 1],
            ['id_sede' => 1, 'id_area' => 2],
            ['id_sede' => 1, 'id_area' => 3],
            ['id_sede' => 2, 'id_area' => 6],
            ['id_sede' => 3, 'id_area' => 3],
            ['id_sede' => 3, 'id_area' => 4],
            ['id_sede' => 4, 'id_area' => 2],
            ['id_sede' => 4, 'id_area' => 4],
            ['id_sede' => 5, 'id_area' => 3],
            ['id_sede' => 7, 'id_area' => 6],
            ['id_sede' => 6, 'id_area' => 3],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sedes_areas');
    }
}