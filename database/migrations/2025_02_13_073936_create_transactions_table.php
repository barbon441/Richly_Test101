<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('transaction_id');
            $table->decimal('amount', 10, 2);
            $table->string('transaction_type');
            $table->text('description')->nullable();
            $table->date('transaction_date');
            $table->timestamps();
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories', 'categories_id')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('transactions');
    }
};
