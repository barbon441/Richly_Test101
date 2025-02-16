<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('reports', function (Blueprint $table) {
            $table->id('reports_id');
            $table->string('reports_type');
            $table->decimal('total_income', 10, 2);
            $table->decimal('total_expense', 10, 2);
            $table->date('reported_date');
            $table->timestamps();
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('reports');
    }
};
