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
            $table->string("situacao");
				    $table->integer("user_id")->unsigned();
				    $table->timestamps();
			 });

				Schema::table('processos', function($table) {
					$table->foreign('user_id')
						->references('id')
						->on('users');

				});

       DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }

    public function down()
    {
        Schema::drop('processos');
    }
}
