<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckstockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkstock', function (Blueprint $table) {
            $table->id();
            $table->string('checkstock_no', 45);
            $table->timestamp('inspection_date');
            $table->tinyInteger('status_id');
            $table->text('remark');
            $table->tinyInteger('deleted');
            $table->integer('warehouse_id');
            $table->tinyInteger('checkstock_type');
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
        Schema::dropIfExists('checkstock');
    }
}
