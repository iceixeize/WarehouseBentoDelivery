<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarcodePaperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barcode_paper', function (Blueprint $table) {
            $table->integer('id');
            $table->string('papername', 45);
            $table->double('width_box');
            $table->double('height_box');
            $table->double('gap_row');
            $table->double('gap_col');
            $table->integer('row_default');
            $table->integer('col_default');
            $table->double('page_space_l');
            $table->double('page_space_r');
            $table->double('page_space_t');
            $table->double('page_space_b');
            $table->integer('border');
            $table->double('border_padding_l');
            $table->double('border_padding_r');
            $table->double('border_padding_t');
            $table->double('border_padding_b');
            $table->integer('barcode_font_size');
            $table->integer('barcode_scale_barcode');
            $table->integer('barcode_thinkness');

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
        Schema::dropIfExists('barcode_paper');
    }
}
