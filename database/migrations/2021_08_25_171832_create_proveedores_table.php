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
      $table->string('nombres');
      $table->string('apellidos');
      $table->tinyInteger('tipo_documento')->default(null);
      $table->integer('nro_documento');
      $table->string('celular1')->default(null)->nullable();
      $table->string('celular2')->default(null)->nullable();
      $table->string('direccion')->default(null)->nullable();
      $table->string('email')->default(null)->nullable();
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
