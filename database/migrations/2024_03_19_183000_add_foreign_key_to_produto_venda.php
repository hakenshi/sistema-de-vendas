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
        Schema::table('produto_venda', function (Blueprint $table) {
            $table->unsignedBigInteger('id_venda')->after('id');
            $table->foreign('id_venda')->references('id')->on('vendas');
            $table->unsignedBigInteger('id_produto')->after('id_venda');
            $table->foreign('id_produto')->references('id')->on('produtos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produto_venda', function (Blueprint $table) {
            $table->dropForeign('id_venda');
            $table->dropForeign('id_produto');
        });
    }
};
