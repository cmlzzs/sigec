<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('lotes', function (Blueprint $table) {
            // Se a coluna for ENUM, adicione o valor "Em Produção"
            $table->enum('status', ['Entregue', 'Em Produção'])->change();
        });
    }

    public function down()
    {
        Schema::table('lotes', function (Blueprint $table) {
            // Reverte a alteração, removendo o valor "Em Produção" caso seja necessário
            $table->enum('status', ['Entregue', 'Inativo'])->change();
        });
    }
};
