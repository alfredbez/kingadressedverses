<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSongsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('songs', function($table){
            $table->increments('id');
            $table->string('title');
            $table->string('original_title');
            // $table->integer('category_id');
            // $table->foreign('category_id')->references('id')->on('categories');
            // $table->integer('composer_id');
            // $table->foreign('composer_id')->references('id')->on('composers');
            // $table->integer('orchestration_id');
            // $table->foreign('orchestration_id')->references('id')->on('orchestrations');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('songs');
	}

}
