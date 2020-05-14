<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomOrderShippingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_order_shipping', function (Blueprint $table) {
            $table->bigIncrements('custom_order_shipping_id');
            $table->foreignId('outbound_task_id')->references('id')->on('outbond_task');
            $table->integer('bento_store_id');
            $table->tinyInteger('deleted');
            $table->timestamp('date_shipping');
            $table->integer('warehouse_id');
            $table->tinyInteger('shipped');
            $table->text('remark');
            $table->decimal('additional_price', 6, 2);
            $table->string('tracking_no', 30);
            $table->text('shipped_address_1');
            $table->text('shipped_address_2');
            $table->string('zipcode', 10);
            $table->string('shipping_subdistrict', 45);
            $table->string('shipping_district', 45);
            $table->string('shipping_province', 45);
            $table->string('shipping_firstname', 45);
            $table->string('shipping_lastname', 45);
            $table->string('shipping_phone', 45);
            $table->string('shipping_country_name', 45);
            $table->mediumInteger('shipping_country_id', 7);
            $table->string('langs', 10);
            $table->tinyInteger('is_alpha_exchange');
            $table->string('exchange_remark', 100);
            $table->decimal('cod_amount', 10, 2);
            $table->tinyInteger('is_delivered');
            $table->string('shipping_email', 150);
            $table->decimal('provider_cod_charge_price', 10, 2);
            $table->decimal('customer_cod_charge_price', 10, 2);
            $table->tinyInteger('cod_is_ready_pay');
            $table->bigInteger('payment_doc_id');
            $table->timestamp('cod_date_create');
            $table->tinyInteger('cod_is_received');
            $table->decimal('cod_is_received', 5, 2);
            $table->decimal('cod_customer_charge', 5, 2);
            $table->bigInteger('cod_ref_row');
            $table->tinyInteger('cod_confirm_paid');
            $table->integer('store_id');
            $table->foreignId('shipping_provider_id')->references('id')->on('shipping_provider');
            $table->foreignId('warehouse_order_id')->references('id')->on('warehouse_order');
            $table->string('custom_order_no', 45);
            $table->foreignId('user_id')->references('user_id')->on('users');
            $table->text('setting_packing_details');
            $table->integer('resend_order_id');
            $table->text('remark_separate');
            $table->text('remark_packing');
            $table->text('payment_type');  
            
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
        Schema::dropIfExists('custom_order_shipping');
    }
}
