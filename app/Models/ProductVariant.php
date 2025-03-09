<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    // Tên bảng trong database
    protected $table = 'product_variant';

    // Các cột được phép điền dữ liệu (Mass Assignment)
    protected $fillable = [
        'product_id',
        'variant_id',
        'created_at',
        'updated_at',
    ];

    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

   
    public function variant()
    {
        return $this->belongsTo(Variant::class, 'variant_id');
    }
}
