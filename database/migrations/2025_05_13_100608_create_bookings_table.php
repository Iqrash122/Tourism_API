<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_status'); // public, draft, closed
            $table->integer('booking_person');
            $table->decimal('booking_price', 8, 2); // Added precision for decimal
            $table->foreignId('booking_tour')->constrained('tours')->onDelete('cascade');
            $table->foreignId('booking_customer')->constrained('customers')->onDelete('cascade');
            $table->date('booking_date');
            $table->time('booking_time'); // Stores in HH:MM:SS format
            $table->string('booking_order_id', 7)->unique(); // 7-character unique string
            $table->timestamps();

            // Optional: Add index for better performance
            $table->index('booking_date');
            $table->index('booking_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
