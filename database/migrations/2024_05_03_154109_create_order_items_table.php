<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();  // Single primary key for each order-pizza relationship
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('pizza_id')->constrained('pizzas')->onDelete('cascade');
            $table->double('price')->default('0.00');
            $table->string('size')->default('small');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};

