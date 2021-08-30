<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creditos', function (Blueprint $table) {
            $table->id();
            $table->integer('id_cliente');
            $table->integer('id_deudor');
            $table->integer('id_sede');
            $table->integer('cant_cuotas');
            $table->integer('cant_cuotas_pagadas');
            $table->integer('dia_limite');
            $table->boolean('deudor')->comment('Solo se confirma si tiene deudor');
            $table->tinyInteger('estado')->default(0)->nullable();
            $table->date('fecha_inicio');
            $table->decimal('interes_mensual', $precision = 8, $scale = 2);
            $table->double('porcent_interes_anual', 12, 4);
            $table->double('porcent_interes_mensual', 12, 4);
            $table->integer('usu_crea');
            $table->double('valor_cuota', 12, 4);
            $table->double('valor_credito', 12, 4);
            $table->double('valor_abonado', 12, 4)->nullable();
            $table->double('valor_capital', 12, 4)->nullable();
            $table->double('valor_interes', 12, 4)->nullable();
            $table->timestamps();
        });

        // Schema::table('creditos', function (Blueprint $table) {         
        // });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('creditos');
    }


    /**
     * Se pueden crear tablas temporales, que 
     * son eliminadas cuando el usuario cierra sesión
     *
     * Schema::create('calculations', function (Blueprint $table) {
     *   $table->temporary();    *
     *   // ...
     *});
     **/
}
