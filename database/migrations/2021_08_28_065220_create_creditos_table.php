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
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('deudor_id');
            $table->unsignedBigInteger('sede_id');
            $table->unsignedBigInteger('usu_crea');
            $table->integer('cant_cuotas');
            $table->integer('cant_cuotas_pagadas')->nullable()->default(0);
            $table->integer('dia_limite')->nullable()->default(1);
            $table->boolean('deudor')->comment('Solo se confirma si tiene deudor');
            $table->tinyInteger('estado')->default(0)->nullable()->default(0);
            $table->date('fecha_inicio');
            $table->float('interes', 20, 2)->default(3);
            $table->float('porcentaje_interes_anual', 20, 4)->nullable()->default(0);
            $table->float('valor_cuota', 20, 4);
            $table->float('valor_credito', 20, 4);
            $table->float('valor_abonado', 20, 4)->nullable()->default(0);
            $table->float('valor_capital', 20, 4)->nullable()->default(0);
            $table->float('valor_interes', 20, 4)->nullable()->default(0);

            $table->foreign('cliente_id')
                ->references('id')
                ->on('clientes')
                ->onDelete('cascade');

            $table->foreign('deudor_id')
                ->references('id')
                ->on('clientes')
                ->onDelete('cascade');

            $table->foreign('sede_id')
                ->references('id')
                ->on('sedes')
                ->onDelete('cascade');

            $table->foreign('usu_crea')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');


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
        Schema::dropIfExists('creditos');
    }
}
