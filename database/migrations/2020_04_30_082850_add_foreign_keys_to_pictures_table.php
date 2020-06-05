<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPicturesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pictures', function(Blueprint $table)
		{
			$table->foreign('categorie_id', 'fk_pictures_categories1')->references('id')->on('categories')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('service_id', 'fk_pictures_services1')->references('id')->on('services')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('hotel_id', 'fk_pictures_hotels1')->references('id')->on('hotels')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('room_id', 'fk_pictures_rooms1')->references('id')->on('rooms')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pictures', function(Blueprint $table)
		{
			$table->dropForeign('fk_pictures_categories1');
			$table->dropForeign('fk_pictures_hotel_services1');
			$table->dropForeign('fk_pictures_hotels1');
			$table->dropForeign('fk_pictures_rooms1');
		});
	}

}
