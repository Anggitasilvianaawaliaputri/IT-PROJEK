<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualanTable extends Migration
{
    /**
     * Jalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('nama_barang'); // Nama barang
            $table->date('tanggal'); // Tanggal transaksi
            $table->decimal('harga', 10, 2); // Harga satuan
            $table->integer('jumlah'); // Jumlah barang
            $table->decimal('subtotal', 15, 2); // Subtotal
            $table->decimal('netto', 15, 2); // Netto
            $table->string('satuan'); // Satuan barang
            $table->string('metode_pembayaran'); // Metode pembayaran
            $table->timestamps(); // Timestamps created_at dan updated_at
        });
    }

    /**
     * Hapus migrasi.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penjualan');
    }
}
