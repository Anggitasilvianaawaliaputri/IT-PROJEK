<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('report', function (Blueprint $table) {
            $table->id();
            $table->string('nama_karyawan');  // Tambahkan kolom nama_karyawan
            $table->date('tanggal');          // Tambahkan kolom tanggal
            $table->decimal('pendapatan', 15, 2); // Tambahkan kolom pendapatan
            $table->timestamps();            // Kolom created_at dan updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('report');
    }
};