<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHotelsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('hotels', function(Blueprint $table)
		{
			// $table->foreign('configuration_id', 'fk_hotels_configurations1')->references('id')->on('configurations')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('hotels', function(Blueprint $table)
		{
			// $table->dropForeign('fk_hotels_configurations1');
		});
	}

}
