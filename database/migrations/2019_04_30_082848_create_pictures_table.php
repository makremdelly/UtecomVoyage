<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePicturesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pictures', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('categorie_id')->index('fk_pictures_category_idx')->nullable();
			$table->integer('hotel_id')->index('fk_pictures_hotel_idx')->nullable();
			$table->integer('room_id')->index('fk_pictures_rooms1_idx')->nullable();
			$table->integer('service_id')->index('fk_pictures_services1_idx')->nullable();
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
		Schema::drop('pictures');
	}

}
