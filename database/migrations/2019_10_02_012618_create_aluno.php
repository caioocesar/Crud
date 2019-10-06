<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAluno extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aluno', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome',255);
            $table->string('matricula',10);
            $table->string('cpf',11);
            $table->foreign('endereco_id')->references('id')->on('endereco');
            $table->timestamps();
        });
        Schema::create('endereco', function (Blueprint $table) {
            $table->increments('id');
            $table->string('logradouro',255);
            $table->string('numero',45);
            $table->string('bairro',255);
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
        Schema::dropIfExists('aluno');
    }
}
