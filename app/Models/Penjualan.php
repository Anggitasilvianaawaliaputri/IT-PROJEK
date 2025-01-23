<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Support\Facades\DB; // Untuk DB facade

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan'; // Nama tabel
    protected $fillable = [
        'nama_barang',
        'tanggal',
        'harga',
        'jumlah',
        'subtotal',
        'netto',
        'satuan',
        'metode_pembayaran',
    ];

    public function item()
    {
        return $this->belongsTo(Penjualan::class, 'nama_barang', 'nama_barang'); // Model Penjualan
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Event model untuk sinkronisasi dengan tabel products.
     */
    protected static function booted()
    {
        static::created(function ($penjualan) {
            $product = Product::firstOrNew(['nama' => $penjualan->nama_barang]);

            // Hitung jumlah baru
            $product->harga = $penjualan->harga;
            $product->jumlah = ($product->jumlah ?? 0) + $penjualan->jumlah; // Gunakan 0 jika null
            $product->save();
        });

        static::deleted(function ($penjualan) {
            $product = Product::where('nama', $penjualan->nama_barang)->first();

            if ($product) {
                // Kurangi jumlah
                $product->jumlah -= $penjualan->jumlah;

                // Hapus jika jumlah <= 0
                if ($product->jumlah <= 0) {
                    $product->delete();
                } else {
                    $product->save();
                }
            }
        });
    }
}
