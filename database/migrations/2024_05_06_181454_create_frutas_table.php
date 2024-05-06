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
        Schema::create('frutas', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 50)->unique();
            $table->longText('descrição', 150);
            $table->string('imagem', 100)->comment('Imagem da fruta');
            $table->float('preço', 10,2);
            $table->integer('Estoque');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frutas');
    }
};