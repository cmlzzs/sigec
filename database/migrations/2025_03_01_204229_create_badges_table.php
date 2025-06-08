<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
{
    Schema::create('badges', function (Blueprint $table) {
        $table->id();
        $table->string('nome');
        $table->string('matricula'); 
        $table->string('setor');
        $table->enum('status', ['Pendente', 'Em uso', 'Disponível'])->default('Pendente'); 
        $table->string('foto'); 
        $table->boolean('retirado')->default(false);
        $table->foreignId('lote_id')->constrained('lotes'); 
        $table->string('protocolo')->unique();
        $table->text('mensagem')->nullable();
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('badges');
    }
};
