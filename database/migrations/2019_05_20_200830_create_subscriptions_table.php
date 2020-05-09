<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->integer('user_id')->index('fk_subscriptions_user_idx')->nullable();
            $table->integer('hotel_id')->index('fk_subscriptions_hotel_idx')->nullable();
            $table->integer('history_id')->index('fk_subscriptions_history_idx')->nullable();
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
