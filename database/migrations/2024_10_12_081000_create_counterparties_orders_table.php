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
        Schema::create('counterparties_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('counterpart_id')->constrained('counterparties')->onDelete('cascade');
            //Ответственный менеджер
            //Информация о входящих платежах по заказу (дата, сумма, статус)
            $table->string('order_number')->unique();
            $table->string('delivery_address')->unique();
            $table->date('order_date');
            $table->text('order_details')->nullable();
            $table->integer('order_price')->nullable(); //Сумма заказа (Рубли, доллары, крипта)
            $table->enum('status', ['pending', 'processing', 'completed', 'canceled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counterparties_orders');
    }
};
