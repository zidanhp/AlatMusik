<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->dateTime('order_date');
            $table->decimal('total_price', 10, 2);
            $table->enum('status', ['pending', 'approved', 'completed', 'cancelled'])->default('pending');
            $table->text('notes')->nullable();
            $table->enum('rental_status', ['not_rented', 'rented', 'returned'])->default('not_rented');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};