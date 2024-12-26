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
        Schema::create('revenue', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_awal');   // Kolom untuk tanggal awal
            $table->date('tanggal_akhir');  // Kolom untuk tanggal akhir
            $table->decimal('pendapatan', 15, 2); // Kolom untuk total pendapatan (dengan format desimal)
            $table->timestamps();  // Kolom untuk timestamps (created_at dan updated_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revenue');
    }
};