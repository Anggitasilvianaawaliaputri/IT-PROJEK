<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Support\Facades\DB; // Tambahkan ini untuk mengimpor DB facade

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';
    protected $fillable = [
        'nama_barang',
        'tanggal',
        'harga',
        'jumlah',
        'subtotal',
        'netto',
        'metode_pembayaran',
    ];

    public function item()
    {
        return $this->belongsTo(Sale::class, 'nama_barang', 'nama_barang');
    }

    /**
     * Event model untuk sinkronisasi dengan tabel products.
     */
    protected static function booted()
{
    static::created(function ($sale) {
        $product = Product::firstOrNew(['nama' => $sale->nama_barang]);

        // Hitung jumlah baru
        $product->harga = $sale->harga;
        $product->jumlah = ($product->jumlah ?? 0) + $sale->jumlah; // Gunakan 0 jika null
        $product->save();
    });

    static::deleted(function ($sale) {
        $product = Product::where('nama', $sale->nama_barang)->first();

        if ($product) {
            // Kurangi jumlah
            $product->jumlah -= $sale->jumlah;

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