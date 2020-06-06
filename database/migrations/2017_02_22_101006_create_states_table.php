<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->increments('id');
            // NOMENCLATURA PADRÃO DE CHAVE ESTRANGEIRA:
            // NOME DA TABELA RELACIONADA NO SINGULAR + _ID
            $table->integer('country_id')->unsigned();

            // CHAVE ESTRANGEIRA DA TABELA PAÍS
            // IRÁ VINCULAR ESTA TABELA DE ESTADOS AO PAÍS ESPECÍFICO
            $table->foreign('country_id')  // país id
                    ->references('id')     // faz referencia a coluna id
                    ->on('countries')      // da tabela de países
                    ->onDelete('cascade'); // AO DELETAR UM PAÍS, VAI DELETAR ESTE ESTADO

            $table->string('name', 100);
            $table->string('initials', 10); // SIGLA DO ESTADO
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
        Schema::dropIfExists('states');
    }
}
