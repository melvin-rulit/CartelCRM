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
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('amount');
            $table->dropColumn('type');
            $table->double('rent', 20, 2)->default(0);
            $table->double('buyout', 20, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->double('amount', 20);
            $table->string('type', 20);
            $table->dropColumn('rent');
            $table->dropColumn('buyout');
        });
    }
};
