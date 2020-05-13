<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoxesHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boxes_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('boxes_id')->references('id')->on('boxes');
            $table->foreignId('user_id')->references('user_id')->on('users');
            $table->foreignId('action_id')->references('id')->on('action_name');
            $table->foreignId('package_option_id')->references('id')->on('packing_option');
            $table->foreignId('packing_option_package_id')->references('id')->on('packing_option_package');
            $table->timestamp('datetime');

            $table->timestamps(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boxes_history');
    }
}
