<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang',
        'category_id',
        'harga',
        'jumlah',
        'gambar',
        'netto',
    ];

    public function transactions()
    {
        return $this->belongsToMany(Transaction::class, 'transaction_item', 'item_id', 'transaction_id')
                    ->withPivot('quantity', 'unit_price', 'total_price')
                    ->withTimestamps();
    }
    

    // Relasi ke Category
    public function category()
{
    return $this->belongsTo(Category::class, 'category_id', 'id');
}

}
