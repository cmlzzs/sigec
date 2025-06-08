<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        public function up(): void {
            Schema::table('badges', function (Blueprint $table) {
                $table->dropColumn('retirado');
            });
        }
    
        public function down(): void {
            Schema::table('badges', function (Blueprint $table) {
                $table->boolean('retirado')->default(false); // Ajuste o tipo conforme necessário
            });
        }
    };
    

