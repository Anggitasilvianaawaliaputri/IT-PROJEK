<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TPK extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang',
        'harga',
        'total_jumlah',
        'netto',
    ];
}
