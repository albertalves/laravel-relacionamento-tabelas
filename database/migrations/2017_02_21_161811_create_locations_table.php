<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     *  RELAÇÃO 1-1 = UM PAÍS POSSUI UMA LOCALIZAÇÃO E UMA LOCALIZAÇÃO POSSUI UM PAÍS
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id')->unsigned();
            // CHAVE ESTRANGEIRA DA TABELA PAÍS
            // IRÁ VINCULAR ESTA TABELA DE LOCALIZAÇÃO AO PAÍS ESPECÍFICO
            $table->foreign('country_id')
                    ->references('id')
                    ->on('countries')
                    ->onDelete('cascade');  // ao deletar um país, também deletar sua localização
            $table->integer('latitude');    // campos integer não se passa quantidade
            $table->integer('longitude');   // campos integer não se passa quantidade
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
