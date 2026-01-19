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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->integer('table_number');
        $table->string('customer_name')->nullable();
        $table->enum('payment_method', ['cash', 'qris'])->default('cash');
        $table->decimal('total_price', 10, 2)->default(0);
        $table->enum('status', ['pending','paid','completed','cancelled'])->default('pending');
        $table->timestamps();
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
