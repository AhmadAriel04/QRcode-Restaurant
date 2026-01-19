<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();

            // Foreign key yang benar
            $table->foreignId('category_id')
                  ->constrained('categories')
                  ->onDelete('cascade');

            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('rating')->default(0);
            $table->integer('price');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
