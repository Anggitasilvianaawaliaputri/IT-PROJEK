<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;
    protected $table = 'kriterias'; // Nama tabel di database
    protected $fillable = ['nama', 'bobot']; // Kolom yang bisa diisi secara massal

    /**
     * Relasi ke Value
     */
    public function values()
    {
        return $this->hasMany(Value::class, 'kriteria_id');
    }
}
