<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    use HasFactory;
    
    // Kolom yang dapat diisi secara massal (mass assignment)
    protected $fillable = ['tanggal_awal', 'tanggal_akhir', 'pendapatan'];

    
    // Jika tabel sudah dinamai 'posts', tidak perlu menyetel $table
    protected $table = 'revenue';
}