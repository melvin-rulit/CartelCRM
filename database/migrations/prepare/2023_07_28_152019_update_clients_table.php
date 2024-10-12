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
        Schema::table('clients', static function (Blueprint $table) {
            $table->dropColumn('full_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->date('birthday');
            $table->string('passport_series');
            $table->string('passport_number');
            $table->string('passport_notes');
            $table->string('registration_address');
            $table->string('residence_address');
            $table->string('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', static function (Blueprint $table) {
            $table->string('full_name');
            $table->dropColumn('first_name');
            $table->dropColumn('middle_name');
            $table->dropColumn('last_name');
            $table->dropColumn('birthday');
            $table->dropColumn('passport_series');
            $table->dropColumn('passport_number');
            $table->dropColumn('passport_notes');
            $table->dropColumn('registration_address');
            $table->dropColumn('residence_address');
            $table->dropColumn('email');
        });
    }
};
