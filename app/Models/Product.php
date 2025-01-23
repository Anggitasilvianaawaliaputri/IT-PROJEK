<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products'; // Nama tabel
    protected $fillable = ['nama', 'harga', 'jumlah']; // Kolom yang dapat diisi

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    /**
     * Accessor untuk menghitung total netto dari semua transaksi penjualan terkait.
     *
     * @return int
     */
    public function getNettoAttribute()
    {
        // Menghitung total netto dari relasi sales
        return $this->sales->sum('netto');
    }
}
