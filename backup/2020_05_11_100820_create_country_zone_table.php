<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryZoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country_zone', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->references('id')->on('country');
            $table->integer('stpz_id');
            $table->integer('weight_limit');
            $table->tinyInteger('active');
            $table->tinyInteger('deleted');
            
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
        Schema::dropIfExists('country_zone');
    }
}