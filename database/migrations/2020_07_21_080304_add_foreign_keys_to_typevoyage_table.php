<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToTypevoyageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('typevoyages', function (Blueprint $table) {
			$table->foreign('voyage_id', 'fk_typevoyage_voyages1')->references('id')->on('voyages')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('typevoyages', function (Blueprint $table) {
            $table->dropForeign('fk_typevoyage_voyages1');    
                });
    }
}
