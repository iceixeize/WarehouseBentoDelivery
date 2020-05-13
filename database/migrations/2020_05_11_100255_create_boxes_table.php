<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boxes', function (Blueprint $table) {
            $table->id();
            $table->string('box_name', 45);
            $table->decimal('box_price', 6, 2);
            $table->tinyInteger('deleted');
            $table->string('barcode', 45);
            $table->float('width');
            $table->decimal('cost_box_price', 6, 2);
            $table->decimal('resend_box_price', 6, 2);

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
        Schema::dropIfExists('boxes');
    }
}
