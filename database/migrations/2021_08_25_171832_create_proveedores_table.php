<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->char('nombres', 100);
            $table->char('apellidos', 100);
            $table->char('tipo_documento', 40)->default('Cédula de ciudadanía');
            $table->double('nro_documento', 20, 0);
            $table->char('genero', 20)->nullable();
            $table->char('celular1', 20);
            $table->char('celular2', 20)->nullable();
            $table->char('direccion', 200)->nullable();
            $table->string('email')->unique();
            $table->tinyInteger('estado')->default(1);
            $table->softDeletes($column = 'deleted_at', $precision = 0);
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
        Schema::dropIfExists('proveedores');
    }
}
