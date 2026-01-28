<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('booking_tables', function (Blueprint $table) {
            $table->id();
           $table->string('order_id')->unique();
            $table->unsignedBigInteger('cart_id'); // relationship to cart table
            $table->unsignedBigInteger('asset_id'); // product/asset ID
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('country');
            $table->string('house_address');
            $table->string('city');
            $table->string('state');
            $table->string('zip_code');
            $table->string('asset_type');
            $table->string('user_id');
            $table->enum('order_status', ['pending', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_tables');
    }
};
