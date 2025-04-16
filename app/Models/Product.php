<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'nama',
        'deskripsi',
        'harga',
        'stok',
        'category_id',
        'gambar',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
