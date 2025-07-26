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
        Schema::create('consumables', function (Blueprint $table) {
            $table->id()->primary();
            $table->foreignId('category_id')->references('id')->on('categories');
            $table->foreignId('supplier_id')->references('id')->on('suppliers')->nullOnDelete();
            $table->string('name')->unique();
            $table->json('description');
            $table->integer('stock');
            $table->string('unidade');
            $table->string('validade');
            $table->dateTime('entry_date');
            $table->dateTime('last_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consumables');
    }
};
