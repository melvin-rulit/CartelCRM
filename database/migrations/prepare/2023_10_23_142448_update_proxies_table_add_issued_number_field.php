<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('Providers', function (Blueprint $table) {
            $table->string('issued_number');
            $table->dropColumn('issued_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Providers', function (Blueprint $table) {
            $table->date('issued_date');
            $table->dropColumn('issued_number');
        });
    }
};
