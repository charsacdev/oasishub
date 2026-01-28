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
        Schema::create('assets_tables', function (Blueprint $table) {
            $table->id();
            $table->string('asset_name');
            $table->json('asset_photos');
            $table->string('asset_category');
            $table->string('asset_type');
            $table->string('asset_price');
            $table->longText('asset_description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets_tables');
    }
};
