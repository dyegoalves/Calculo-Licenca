<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalculosTable extends Migration
{


    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Schema::create('calculos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->decimal('valor', 10,2);
            $table->integer('processo_id')->unsigned();
            $table->integer('empresa_id')->unsigned();
            $table->timestamps();

        });

        Schema::table('calculos', function($table) {

            $table->foreign('processo_id')->references('id')->on('processos')
                ->onDelete('cascade');

            $table->foreign('empresa_id')->references('id')->on('empresas')
                ->onDelete('cascade');

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
        Schema::drop('calculos');
    }
}
