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
        Schema::table('produks', function (Blueprint $table) {
            // Periksa apakah kolom 'jumlah' sudah ada sebelum menambahkannya
            if (!Schema::hasColumn('produks', 'jumlah')) {
                $table->decimal('jumlah', 8, 2)->after('produk_id')->default(0); // Tambahkan kolom jumlah
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            // Hapus kolom 'jumlah' jika ada
            if (Schema::hasColumn('produks', 'jumlah')) {
                $table->dropColumn('jumlah');
            }
        });
    }
};
