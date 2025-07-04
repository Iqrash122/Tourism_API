<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\text;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('support_queries', function (Blueprint $table) {
            $table->id();
            $table->text('customer_name');
            $table->text('customer_email');
            $table->enum('type', ['tour', 'booking']);
            $table->text('query');
            $table->enum('status', ['open', 'in_progress', 'closed'])->default('open');
            $table->text('response')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_queries');
    }
};
