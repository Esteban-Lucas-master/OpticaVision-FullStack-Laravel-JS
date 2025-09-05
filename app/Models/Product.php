<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
    'name',
    'description',
    'price',
    'stock',
    'on_offer',
    'seller_id', // ✅ Coincide con la columna de la BD
];

public function seller()
{
    return $this->belongsTo(User::class, 'seller_id'); // ✅ Coincide con la columna
}

    // 📷 Relación con imágenes
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}

