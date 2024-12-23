<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    use HasFactory;
    protected $table = 'values'; // Nama tabel di database
    protected $fillable = ['produk_id', 'kriteria_id', 'nilai']; // Kolom yang bisa diisi secara massal

    /**
     * Relasi ke Produk
     */
    public function produk()
    {
        return $this->hasMany(Value::class, 'produk_id');
    }

    /**
     * Relasi ke Kriteria
     */
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }
}
