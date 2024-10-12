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
        Schema::create('actives', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->string('body_number');
            $table->string('reg_number');
            $table->integer('year');
            $table->integer('color_id');
            $table->decimal('cost', 15);
            $table->integer('investor_id');
            $table->integer('branch_id');
            $table->date('osago');
            $table->string('document_series');
            $table->string('document_number');
            $table->date('document_date');
            $table->string('document_notes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actives');
    }
};
