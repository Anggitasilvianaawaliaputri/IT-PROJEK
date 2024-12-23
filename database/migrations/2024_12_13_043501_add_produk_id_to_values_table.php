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
        if (!Schema::hasColumn('values', 'produk_id')) {
            Schema::table('values', function (Blueprint $table) {
                $table->foreignId('produk_id')->constrained('produks')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('values', 'produk_id')) {
            Schema::table('values', function (Blueprint $table) {
                $table->dropForeign(['produk_id']);
                $table->dropColumn('produk_id');
            });
        }
    }
};
