<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tl_com_shipping_integrations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('order_product_id');
            $table->string('carrier_name')->nullable();
            $table->string('tracking_number')->nullable();
            $table->text('shipping_label_url')->nullable();
            $table->json('api_response')->nullable();
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('tl_com_orders')->onDelete('cascade');
            $table->foreign('order_product_id')->references('id')->on('tl_com_ordered_products')->onDelete('cascade');

            $table->index(['order_id', 'order_product_id']);
            $table->index('tracking_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tl_com_shipping_integrations');
    }
};
