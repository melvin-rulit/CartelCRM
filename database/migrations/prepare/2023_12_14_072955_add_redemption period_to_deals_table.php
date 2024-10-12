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
            $table->string('redemption_period')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('CounterpartiesOrders', function (Blueprint $table) {
            $table->dropColumn('redemption_period');
        });
    }
};
