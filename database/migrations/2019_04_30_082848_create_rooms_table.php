<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRoomsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rooms', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name')->nullable();
			$table->string('vue')->nullable();
			$table->integer('total')->nullable();
			$table->integer('persons')->nullable();
			$table->double('surface', 3, 2)->nullable();
			$table->longText('description')->nullable();
			$table->boolean('availibility')->nullable();
			$table->integer('hotel_id')->index('fk_rooms_hotel_idx');
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('rooms');
	}

}
