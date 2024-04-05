<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('produto_venda', function (Blueprint $table) {
            if (Schema::hasColumn('produto_venda', 'produto_id')) {
                $table->dropForeign(['produto_id']);
                $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade');
            }
            if (Schema::hasColumn('produto_venda', 'venda_id')) {
                $table->dropForeign(['venda_id']);
                $table->foreign('venda_id')->references('id')->on('vendas')->onDelete('cascade');
            }
        });
    }

    public function down()
    {
        Schema::table('produto_venda', function (Blueprint $table) {
            if (Schema::hasColumn('produto_venda', 'produto_id')) {
                $table->dropForeign(['produto_id']);
            }
            if (Schema::hasColumn('produto_venda', 'venda_id')) {
                $table->dropForeign(['venda_id']);
            }
        });
    }
};
