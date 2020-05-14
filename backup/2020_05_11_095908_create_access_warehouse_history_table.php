<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessWarehouseHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_warehouse_history', function (Blueprint $table) {
            $table->id();
            $table->integer('action_id');
            $table->integer('edit_user_id');
            $table->integer('access_warehouse');
            $table->timestamp('datetime');
            $table->integer('user_id');
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
        Schema::dropIfExists('access_warehouse_history');
    }
}
