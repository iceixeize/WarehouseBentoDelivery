<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShelfTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shelf', function (Blueprint $table) {
            $table->bigIncrements('shelf_id');
            $table->string('shelf_no', 25);
            $table->tinyInteger('shelf_type');
            $table->tinyInteger('shelf_active');
            $table->tinyInteger('shelf_seq');
            $table->integer('shelf_type_id');
            $table->foreignId('warehouse_id')->references('warehouse_id')->on('warehouse');
            $table->foreignId('rack_id')->references('rack_id')->on('rack');
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shelf');
    }
}
