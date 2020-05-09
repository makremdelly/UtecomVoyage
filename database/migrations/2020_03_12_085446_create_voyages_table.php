<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoyagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voyages', function (Blueprint $table) {
        
            $table->integer('id', true);
			$table->string('type')->nullable();
			$table->string('NbPlace')->nullable();
			$table->string('villeD')->nullable();
			$table->string('depart')->nullable();
            $table->integer('hotel_id')->index('fk_voyages_hotel_idx')->nullable();
            $table->string('retour')->nullable();
            $table->integer('autocar_id')->index('fk_voyages_autocar_idx')->nullable();
            $table->string('prix')->nullable();
            $table->string('startDate')->nullable();
            $table->string('endDate')->nullable();
            $table->string('photo')->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voyages');
    }
}
