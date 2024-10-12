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
        Schema::table('CounterpartiesOrders', function (Blueprint $table) {
            $table->decimal('initial', 18)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('CounterpartiesOrders', function (Blueprint $table) {
            $table->dropColumn('initial');
        });
    }
};
