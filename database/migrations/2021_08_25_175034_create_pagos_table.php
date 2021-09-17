<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->integer('tipo_deuda');
            $table->foreignId('id_deuda')->nullable();
            $table->double('valor_pago', 12, 2);
            $table->integer('nro_cuota');
            $table->double('valor_interes', 12, 2)->nullable()->default('0');
            $table->double('valor_capital', 12, 2)->nullable();
            $table->foreignId('id_tercero')->nullable();
            $table->date('fecha_pago');
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
        Schema::dropIfExists('pagos');
    }
}

