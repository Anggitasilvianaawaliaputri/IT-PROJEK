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
        if (Schema::hasColumn('sales', 'nama_karyawan')) {
            Schema::table('sales', function (Blueprint $table) {
                $table->dropColumn('nama_karyawan');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->string('nama_karyawan')->nullable(); // Tipe asli kolom
        });
    }
};
