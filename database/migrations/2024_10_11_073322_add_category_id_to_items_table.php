<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::table('items', function (Blueprint $table) {
            // Tambahkan kolom 'category_id' hanya jika belum ada
            if (!Schema::hasColumn('items', 'category_id')) {
                $table->foreignId('category_id')
                    ->nullable()
                    ->constrained()
                    ->onDelete('cascade');
            }
        });
    }

    /**
     * Balikkan migrasi.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            // Hapus foreign key dan kolom 'category_id' hanya jika kolom ini ada
            if (Schema::hasColumn('items', 'category_id')) {
                $table->dropForeign(['category_id']); // Hapus foreign key
                $table->dropColumn('category_id');   // Hapus kolom
            }
        });
    }
};