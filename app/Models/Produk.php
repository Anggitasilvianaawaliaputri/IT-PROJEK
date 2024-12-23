<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produks'; // Nama tabel di database
    protected $fillable = ['nama', 'harga', 'deskripsi']; // Kolom yang bisa diisi secara massal

    /**
     * Relasi ke Value
     */
    public function values()
    {
        return $this->hasMany(Value::class, 'produk_id');
        
    }
}
