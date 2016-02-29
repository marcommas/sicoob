<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCronicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cronicas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('de_cronica', 100);
            $table->integer('posicao')->unique;
            $table->char('ativo', 1);
            $table->string('caminho_arquivo', 500);
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
        Schema::drop('cronicas');
    }
}
