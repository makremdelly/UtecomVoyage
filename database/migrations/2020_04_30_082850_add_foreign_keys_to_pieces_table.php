<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPiecesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pieces', function(Blueprint $table)
		{
			$table->foreign('room_id', 'fk_pieces_rooms1')->references('id')->on('rooms')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pieces', function(Blueprint $table)
		{
			$table->dropForeign('fk_pieces_rooms1');
		});
	}

}
