<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rack', function (Blueprint $table) {
            $table->bigIncrements('rack_id');
            $table->string('rack_no', 45);
            $table->tinyInteger('rack_unit');
            $table->boolean('rack_active');
            $table->foreignId('warehouse_id')->references('warehouse_id')->on('warehouse');
            $table->mediumInteger('pick_seq');
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
        Schema::dropIfExists('rack');
    }
}
