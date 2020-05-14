<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigPriceRateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_price_rate', function (Blueprint $table) {
            $table->id();
            $table->integer('rate_start');
            $table->integer('rate_end');
            $table->integer('rate_price');
            $table->tinyInteger('is_per_qty');
            $table->string('type', 45);
            $table->tinyInteger('deleted');
            $table->text('description');
            $table->foreignId('store_id')->references('store_id')->on('store');


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
        Schema::dropIfExists('config_price_rate');
    }
}
