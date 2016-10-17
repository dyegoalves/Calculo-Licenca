<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubatividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Schema::create('subatividades', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('codigo');
            $table->string('descricao');
            $table->integer('atividade_id')->unsigned();
            $table->integer('ppd_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('subatividades', function($table) {
            $table->foreign('atividade_id')->references('id')->on('atividades');
            $table->foreign('ppd_id')->references('id')->on('ppds');
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
        Schema::drop('subatividades');
    }
}
