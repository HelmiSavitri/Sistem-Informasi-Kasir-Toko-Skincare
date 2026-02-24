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
    Schema::create('ratings', function (Blueprint $table) {
        $table->id();
        // Menghubungkan ke tabel transactions
        $table->foreignId('transaction_id')->constrained('transactions')->onDelete('cascade');
        // Menghubungkan ke tabel users (siapa kasirnya)
        $table->foreignId('user_id')->constrained('users'); 
        $table->integer('score'); // Skala 1-5
        $table->text('comment')->nullable(); // Komentar opsional
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
