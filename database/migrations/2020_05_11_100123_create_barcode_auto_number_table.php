<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarcodeAutoNumberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barcode_auto_number', function (Blueprint $table) {
            $table->integer('auto_number_id');
            $table->string('keyword', 20);
            $table->string('value', 20);
            $table->integer('seq');
            $table->string('prefix', 5);

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
        Schema::dropIfExists('barcode_auto_number');
    }
}
