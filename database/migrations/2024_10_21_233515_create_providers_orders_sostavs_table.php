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
        Schema::create('providers_orders_sostavs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provider_order_id')->constrained('providers_orders')->onDelete('cascade');
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->enum('state', ['new', 'used', 'damaged'])->nullable()->default(null);
            $table->string('params_model')->nullable();
            $table->string('color')->nullable();
            $table->string('city')->nullable();
            $table->string('series_number')->nullable();
            $table->string('prise')->nullable();
            $table->string('prise_pay')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('providers_orders_sostavs');
    }
};
