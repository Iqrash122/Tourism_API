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
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->string('activity_title');
            $table->string('activity_slug')->unique();
            $table->string('seo_title')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->string('seo_description')->nullable();
            $table->json('price_variations')->nullable();
            $table->json('time_variations')->nullable();
            $table->text('body');
            $table->string('activity_location');
            $table->string('yt_url')->nullable();
            $table->text('activity_multiple_images')->nullable();
            $table->string('activity_categories')->nullable();
            $table->string('activity_cities')->nullable();
            $table->json('feature_offers')->nullable();
            $table->json('promotion_tours')->nullable();
            $table->boolean('top_rated')->default(0);
            $table->decimal('rating_bar')->default(0);
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
