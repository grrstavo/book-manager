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
        Schema::create('Livro_Assunto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Livro_Codl')->references('Codl')->on('Livro')->onDelete('cascade');
            $table->foreignId('Assunto_codAs')->references('codAs')->on('Assunto')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Livro_Assunto');
    }
};
