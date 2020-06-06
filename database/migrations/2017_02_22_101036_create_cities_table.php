<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('state_id')->unsigned(); 

            // CHAVE ESTRANGEIRA DE ESTADO
            // IRÁ VINCULAR ESTA TABELA DE CIDADE AO ESTADO ESPECÍFICO
            $table->foreign('state_id')    // estado id
                    ->references('id')     // faz referencia a coluna id
                    ->on('states')         // da tabela de estados
                    ->onDelete('cascade'); // AO DELETAR UM ESTADO, DELETAR ESTA CIDADE

            $table->string('name', 100);
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
        Schema::dropIfExists('cities');
    }
}
