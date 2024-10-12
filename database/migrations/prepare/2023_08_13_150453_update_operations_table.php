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
        Schema::dropIfExists('operations');
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('active_id');
            $table->foreign('active_id')->references('id')->on('actives')->onDelete('cascade');
            $table->string('name');
            $table->integer('type');
            $table->datetime('date');
            $table->double('amount', 20);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operations');
    }
};
