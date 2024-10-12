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
        Schema::table('actives', function (Blueprint $table) {
            $table->double('cost_of_rent')->default(0);
            $table->double('cost_of_buyout')->default(0);
            $table->string('osago_number')->default('');;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('actives', function (Blueprint $table) {
            $table->dropColumn('cost_of_rent');
            $table->dropColumn('cost_of_buyout');
            $table->dropColumn('osago_number');
        });
    }
};
