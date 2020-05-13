<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarehouseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse', function (Blueprint $table) {
            $table->bigIncrements('warehouse_id');
            
            $table->text('location_address');
            $table->tinyInteger('deleted');
            
            $table->string('subdomain', 45);
            
            $table->string('subdistrict', 45);
            $table->string('district', 45);
            $table->string('province', 45);
            $table->string('zipcode', 45);
            $table->string('tel', 45);
            
            $table->text('shipping_provider_api_data');
            $table->string('latitude', 80);
            $table->string('longitude', 80);

            $table->string('warehouse_name_th', 45);
            $table->string('contact_th', 45);
            $table->string('address_name_th', 45); 
            $table->text('address_1_th');
            $table->text('address_2_th');
            $table->string('province_name_th', 80);
            $table->string('district_name_th', 80);
            $table->string('subdistrict_name_th', 80);

            $table->string('warehouse_name_en', 45);
            $table->string('contact_en', 45);
            $table->string('address_name_en', 45);
            $table->text('address_1_en');
            $table->text('address_2_en');
            $table->string('province_name_en', 80);
            $table->string('district_name_en', 80);
            $table->string('subdistrict_name_en', 80);
            $table->integer('country_id');
            $table->text('contact_thaipost');



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
        Schema::dropIfExists('warehouse');
    }
}
