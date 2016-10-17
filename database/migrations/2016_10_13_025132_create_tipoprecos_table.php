<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoprecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Schema::create('tipoprecos', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('LP');
            $table->string('LI');
            $table->string('LO');
            $table->integer('ppd_id')->unsigned();

            $table->timestamps();
        });

        Schema::table('tipoprecos', function($table) {
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
        Schema::drop('tipoprecos');
    }
}
