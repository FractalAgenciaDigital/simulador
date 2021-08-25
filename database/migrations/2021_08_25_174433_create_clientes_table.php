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
      $table->tinyInteger('tipo_documento')->default(null);
      $table->integer('nro_documento');
      $table->string('celular1')->default(null);
      $table->string('celular2')->default(null);
      $table->string('direccion')->default(null);
      $table->string('email')->default(null);
      $table->date('fecha_nacimiento')->default(null);
      $table->tinyText('genero')->default(null);
      $table->tinyInteger('activo')->default(1);
      $table->string('estado_civil')->default(null);
      $table->string('lugar_trabajo')->default(null);
      $table->string('cargo')->default(null);
      $table->tinyInteger('independiente')->default(null);
      $table->string('foto')->default(null);
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
