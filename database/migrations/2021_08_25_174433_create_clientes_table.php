<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('apellidos');
            $table->tinyInteger(1);
            $table->integer('documento');
            $table->string('celular1');
            $table->string('celular2');
            $table->string('direccion');
            $table->string('email');
            $table->date('fecha_nacimiento');
            $table->tinyText('genero');
            $table->tinyInteger('activo');
            $table->string('estado_civil');
            $table->string('lugar_trabajo');
            $table->string('cargo');
            $table->tinyInteger('independiente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
