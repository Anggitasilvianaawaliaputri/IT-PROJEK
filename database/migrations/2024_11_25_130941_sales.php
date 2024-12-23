<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('nama_karyawan');
            $table->string('nama_barang');
            $table->date('tanggal');
            $table->decimal('harga', 10, 2);
            $table->unsignedInteger('jumlah');
            $table->decimal('subtotal', 12, 2);
            $table->string('metode_pembayaran');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};