<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';
    protected $fillable = [
        'nama_karyawan',
        'nama_barang',
        'tanggal',
        'harga',
        'jumlah',
        'subtotal',
        'metode_pembayaran',
    ];
}