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
        Schema::create('tl_com_seller_shipping_carriers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seller_id');
            $table->unsignedBigInteger('carrier_id');
            $table->boolean('is_active')->default(false);
            $table->decimal('base_cost', 10, 2)->default(0);
            $table->decimal('cost_per_kg', 10, 2)->default(0);
            $table->decimal('cost_per_km', 10, 2)->default(0);
            $table->decimal('min_cost', 10, 2)->default(0);
            $table->decimal('max_cost', 10, 2)->nullable();
            $table->text('shipping_zones')->nullable();    // JSON array of zones
            $table->text('excluded_zones')->nullable();    // JSON array of excluded zones
            $table->text('weight_ranges')->nullable();     // JSON array of weight-based pricing
            $table->text('distance_ranges')->nullable();   // JSON array of distance-based pricing
            $table->string('api_credentials')->nullable(); // Encrypted API credentials
            $table->text('settings')->nullable();          // JSON settings
            $table->timestamps();

            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('carrier_id')->references('id')->on('tl_com_shipping_courier')->onDelete('cascade');

            $table->unique(['seller_id', 'carrier_id']);
            $table->index(['seller_id', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tl_com_seller_shipping_carriers');
    }
};
