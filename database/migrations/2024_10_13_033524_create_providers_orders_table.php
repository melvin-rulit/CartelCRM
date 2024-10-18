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
        Schema::create('providers_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provider_id')->constrained('providers')->onDelete('cascade');
            $table->string('order_number')->unique();
            $table->date('order_date');
            $table->text('order_details')->nullable();
            $table->integer('order_price')->nullable();
            $table->enum('status', ['for_payment', 'processing', 'completed', 'canceled'])->default('pending');
            $table->boolean('is_paid')->default(false);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('providers_orders');
    }
};
