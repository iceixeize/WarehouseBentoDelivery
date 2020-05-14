<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRackHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rack_history', function (Blueprint $table) {
            $table->bigIncrements('rack_history_id');
            $table->foreignId('rack_id')->references('rack_id')->on('rack');
            $table->foreignId('shelf_id')->references('shelf_id')->on('shelf');
            $table->foreignId('subshelf_id')->references('subshelf_id')->on('subshelf');
            $table->foreignId('action_id')->references('action_id')->on('action_name');
            $table->foreignId('id')->references('id')->on('users');
            $table->foreignId('warehouse_id')->references('warehouse_id')->on('warehouse');

            $table->integer('unit_amount');
            $table->integer('shelf_merge_id');
            $table->integer('shelf_separate_id');
            $table->string('current_name');
            $table->tinyInteger('current_seq');
            $table->tinyInteger('current_unit');
            $table->timestamp('datetime', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rack_history');
    }
}
