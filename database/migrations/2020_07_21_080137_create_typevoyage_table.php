<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypevoyageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('typevoyages', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('type_voyage')->nullable();
            $table->integer('voyage_id')->index('fk_typevoyage_voyage_idx')->nullable();
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
        Schema::dropIfExists('typevoyages');
    }
}
