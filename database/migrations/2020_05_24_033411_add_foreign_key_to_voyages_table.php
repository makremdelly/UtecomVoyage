<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToVoyagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('voyages', function (Blueprint $table) 
        {
            $table->foreign('hotel_id','fk_voyages_hotel')->references('id')->on('hotels')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('autocar_id','fk_voyages_autocars')->references('id')->on('autocars')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('voyages', function (Blueprint $table) {
            $table->dropForeign('fk_voyages_hotel');
            $table->dropForeign('fk_voyages_autocars');
        });
    }
}
