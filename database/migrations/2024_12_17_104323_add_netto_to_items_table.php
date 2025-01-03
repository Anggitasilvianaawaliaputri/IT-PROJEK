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
        Schema::table('items', function (Blueprint $table) {
            // Periksa apakah kolom 'netto' sudah ada sebelum menambahkannya
            if (!Schema::hasColumn('items', 'netto')) {
                $table->decimal('netto', 8, 2)->after('category_id')->default(0); // Tambahkan kolom netto
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            // Hapus kolom 'netto' jika ada
            if (Schema::hasColumn('items', 'netto')) {
                $table->dropColumn('netto');
            }
        });
    }
};
