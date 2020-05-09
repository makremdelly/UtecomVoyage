<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInterventionsHasFilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('interventions_has_files', function(Blueprint $table)
		{
			$table->integer('intervention_id')->index('fk_interventions_has_files_interventions2_idx');
			$table->integer('file_id')->index('fk_interventions_has_files_files2_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('interventions_has_files');
	}

}
