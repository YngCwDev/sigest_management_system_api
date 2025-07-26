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
            $table->id()->primary();
            $table->foreignId('consumable_id')->references('id')->on('consumables');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('department_id')->references('id')->on('departments');
            $table->enum('priority', ['low','normal','high','maximum'])->default('low');
            $table->enum('status',['pending','processing','cancelled', 'completed'])->default('pending');
            $table->string('quantity');
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
