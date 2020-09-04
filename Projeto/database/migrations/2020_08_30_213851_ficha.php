<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Ficha extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Ficha', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mes');
            $table->integer('ano');
            $table->integer('numero da ordem de venda');
            $table->integer('quantidade orçada');

            $table->integer('porto_destino_id')->unsigned()->nullable();
            $table->foreign('porto_destino_id')->references('id')->on('PortoDestino');

            $table->integer('porto_embarque_id')->unsigned()->nullable();
            $table->foreign('porto_embarque_id')->references('id')->on('PortoEmbarque');

            $table->integer('usina_id')->unsigned()->nullable();
            $table->foreign('usina_id')->references('id')->on('Usina');

            $table->integer('Cliente_id')->unsigned()->nullable();
            $table->foreign('Cliente_id')->references('id')->on('Cliente');
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
        //
    }
}
