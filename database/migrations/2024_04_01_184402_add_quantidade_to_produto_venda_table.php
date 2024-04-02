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
            $table->integer('quantidade')->after('valor_venda');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produto_venda', function (Blueprint $table) {
            $table->dropColumn('quantidade');
        });
    }
};
