<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToInterventionsHasFilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('interventions_has_files', function(Blueprint $table)
		{
			$table->foreign('file_id', 'fk_interventions_has_files_files2')->references('id')->on('files')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('intervention_id', 'fk_interventions_has_files_interventions2')->references('id')->on('interventions')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('interventions_has_files', function(Blueprint $table)
		{
			$table->dropForeign('fk_interventions_has_files_files2');
			$table->dropForeign('fk_interventions_has_files_interventions2');
		});
	}

}
