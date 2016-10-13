<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */


    public function up()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::create('empresas', function (Blueprint $table) {

            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('razaoSocial');
            $table->string('nomeFantasia');
            $table->string('CNPJ');
            $table->string('inscEstadual');
            $table->string('email');
            $table->string('telefone');
            $table->string('celular');
            $table->string('endereco');
            $table->string('numero');
            $table->string('complemento');
            $table->string('CEP');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('UF');
            $table->integer('porte_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('empresas', function($table) {

            $table->foreign('porte_id')->references('id')->on('portes')
                ->onDelete('cascade');

        });

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    public function down()
    {
        Schema::drop('empresas');
    }
}
