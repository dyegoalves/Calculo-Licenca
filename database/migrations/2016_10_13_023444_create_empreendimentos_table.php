<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpreendimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Schema::create('empreendimentos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('basedecalculo01');
            $table->string('basedecalculo02');
            $table->integer('processo_id')->unsigned();
            $table->integer('empresa_id')->unsigned();
            $table->integer('porte_id')->unsigned();
            $table->integer('atividade_id')->unsigned();
            $table->integer('subatividade_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('empreendimentos', function($table) {

            $table->foreign('processo_id')->references('id')->on('processos');
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->foreign('porte_id')->references('id')->on('portes');
            $table->foreign('atividade_id')->references('id')->on('atividades');
            $table->foreign('subatividade_id')->references('id')->on('subatividades');

        });


        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('empreendimentos');
    }
}
