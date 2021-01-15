<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contact_name_en');
            $table->string('contact_name_th');
            $table->string('subdomain');
            $table->string('address_name_th');
            $table->string('address_name_en');
            $table->string('address_1_th');
            $table->string('address_1_en');
            $table->string('address_2_th');
            $table->string('address_2_en');
            $table->string('subdistrict_name_th');
            $table->string('subdistrict_name_en');
            $table->string('district_name_th');
            $table->string('district_name_en');
            $table->string('zipcode');
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->string('phone_number');
            $table->string('latitude');
            $table->string('longitude');
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
        Schema::dropIfExists('warehouses');
    }
}
