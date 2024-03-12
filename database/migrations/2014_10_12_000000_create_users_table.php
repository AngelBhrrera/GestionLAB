<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->string('name', 150);
            $table->string('apellido', 150);
            $table->string('correo', 150)->unique();
            $table->string('codigo', 10)->unique()->nullable();
            $table->string('tipo', 50);
            $table->string('telefono', 10)->unique()->nullable();
            $table->string('emergencia', 10)->nullable();
            $table->string('password', 300);

            $table->unsignedInteger('horas')->nullable();
            $table->string('fecha_salida', 100)->nullable();
            $table->string('carrera')->nullable();
            $table->tinyText('centro')->nullable();
            $table->tinyInteger('sede')->default(0);
            $table->tinyInteger('area')->nullable();
            $table->string('horario', 100)->default('No Aplica');

            $table->string('imagen_perfil', 255)->nullable();
            $table->unsignedInteger('experiencia')->default(1)->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            //$table->boolean('can_admin')->nullable()->default(0);
        });
        
    }


    public function down()
    {
        Schema::dropIfExists('users');
    }
}
