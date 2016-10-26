<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcessosTable extends Migration
{


    public function up()
    {

       DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Schema::create('processos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string("num_processo");
            $table->timestamps();
        });

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }

    public function down()
    {
        Schema::drop('processos');
    }
}
