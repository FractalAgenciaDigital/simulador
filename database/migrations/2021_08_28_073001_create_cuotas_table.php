<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuotas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('credito_id');
            $table->integer('nro_cuota');
            $table->float('valor', 20, 4);
            $table->date('fecha_pago');
            $table->float('dias_mora')->nullable()->default(0);
            $table->float('valor_interes_mora', 20, 4)->nullable()->default(0);
            $table->float('valor_pago_interes', 20, 4)->nullable()->default(0);
            $table->float('valor_pago_capital', 20, 4)->nullable()->default(0);
            $table->tinyText('estado')->default(0);
            $table->date('registro_pago')->nullable();
            $table->foreign('credito_id')
                ->references('id')
                ->on('creditos')
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
        Schema::dropIfExists('cuotas');
    }
}
