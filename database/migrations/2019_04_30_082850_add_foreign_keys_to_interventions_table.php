<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToInterventionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('interventions', function(Blueprint $table)
		{
			$table->foreign('hotel_id', 'fk_interventions_hotels1')->references('id')->on('hotels')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('room_id', 'fk_interventions_rooms1')->references('id')->on('rooms')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('interventions', function(Blueprint $table)
		{
			$table->dropForeign('fk_interventions_hotels1');
			$table->dropForeign('fk_interventions_rooms1');
		});
	}

}
