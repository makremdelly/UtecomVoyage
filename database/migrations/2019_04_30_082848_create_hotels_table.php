<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHotelsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hotels', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name')->nullable();
			$table->integer('configuration_id')->index('fk_hotels_configuration_idx')->nullable();
			$table->integer('stars')->nullable();
			$table->string('phone')->nullable();
			$table->longText('description')->nullable();
			$table->string('address')->nullable();
			$table->string('laltitude')->nullable();
			$table->string('longitude')->nullable();
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
		Schema::drop('hotels');
	}

}
