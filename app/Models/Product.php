<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'supplier_id',      // ⭐ الجديد
        'name',
        'description',
        'price',
        'purchase_price',   // ⭐ الجديد
        'image',
        'code',
        'is_available',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'price' => 'decimal:2',
        'purchase_price' => 'decimal:2', // ⭐ الجديد
        'image' => 'array',
    ];

    // العلاقات
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}