<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlphaUsernameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alpha_username', function (Blueprint $table) {
            $table->id();
            $table->string('username', 60);
            $table->string('company_name', 60);
            $table->string('company_short_name', 60);
            $table->string('bank_id', 60);
            $table->string('account_name', 60);
            $table->string('account_number', 60);
            $table->string('firstname', 60);
            $table->string('lastname', 60);
            $table->string('email', 60);
            $table->string('mobile', 60);

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
        Schema::dropIfExists('alpha_username');
    }
}
