<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToConfigurationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('configurations', function(Blueprint $table)
		{
			$table->foreign('template_id', 'fk_configurations_templates1')->references('id')->on('templates')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('configurations', function(Blueprint $table)
		{
			$table->dropForeign('fk_configurations_templates1');
		});
	}

}
