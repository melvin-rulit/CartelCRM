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
        Schema::create('CounterpartiesOrders', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('kind');
            $table->unsignedBigInteger('proxy_id')->nullable();
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('active_id');
            $table->double('remain', 20);
            $table->date('valid_until')->nullable();
            $table->double('cost_of_rent')->default(0);
            $table->double('cost_of_buyout')->default(0);
            $table->string('comment', 2048)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('CounterpartiesOrders');
    }
};
