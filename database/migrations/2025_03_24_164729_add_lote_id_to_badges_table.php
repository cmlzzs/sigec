<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLoteIdToBadgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('badges', function (Blueprint $table) {
            $table->unsignedBigInteger('lote_id')->nullable()->after('retirado'); // adiciona lote_id como chave estrangeira
            $table->foreign('lote_id')->references('id')->on('lotes')->onDelete('cascade'); // relaciona com a tabela lotes
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('badges', function (Blueprint $table) {
            $table->dropForeign(['lote_id']); // remove a chave estrangeira
            $table->dropColumn('lote_id'); // remove a coluna lote_id
        });
    }
}
