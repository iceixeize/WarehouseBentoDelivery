<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubshelfTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subshelf', function (Blueprint $table) {
            $table->bigIncrements('subshelf_id');
            $table->tinyInteger('subshelf_no');
            $table->tinyInteger('subshelf_active');
            $table->tinyInteger('subshelf_available');
            $table->string('subshelf_barcode', 20);
            $table->foreignId('warehouse_id')->references('warehouse_id')->on('warehouse');
            $table->foreignId('rack_id')->references('rack_id')->on('rack');
            $table->foreignId('shelf_id')->references('shelf_id')->on('shelf');
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
        Schema::dropIfExists('subshelf');
    }
}
