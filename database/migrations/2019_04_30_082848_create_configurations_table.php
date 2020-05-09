<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConfigurationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('configurations', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->binary('logo');
			$table->string('slogan', 45);
			$table->string('button_color', 45);
			$table->string('text_color', 45);
			$table->string('nav_color', 45);
			$table->string('nav_text_color', 45);
			$table->integer('template_id')->index('fk_configurations_template_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('configurations');
	}

}
