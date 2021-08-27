<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->default(null)->nullable();
            $table->string('nombre')->default(null)->nullable();
            $table->string('celular')->default(null)->nullable();
            $table->string('direccion')->default(null)->nullable();
            $table->string('tipo_documento')->default(null)->nullable();
            $table->string('documento')->default(null)->nullable();
            $table->string('foto')->default(null)->nullable();
            $table->text('profile_photo_path')->nullable();
            $table->foreignId('current_team_id')->nullable();
            $table->tinyInteger('estado')->default(1);
            $table->foreignId('id_rol')->default(null)->nullable();
            $table->foreignId('id_sede')->default(null)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
