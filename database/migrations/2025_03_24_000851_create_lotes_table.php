<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotesTable extends Migration
{
    public function up()
    {
        Schema::create('lotes', function (Blueprint $table) {
            $table->id(); 
            $table->string('nome');  
            $table->enum('status', ['enviado', 'em andamento', 'na gráfica', 'entregue']);  
            $table->date('data');  
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('lotes');
    }
}
