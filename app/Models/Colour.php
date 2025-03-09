<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colour extends Model
{
    use HasFactory;

    // Các trường được phép gán hàng loạt
    protected $fillable = [
        'name',
        'quantity',
        'price',
        'product_id',
    ];

    // Định nghĩa mối quan hệ với model Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }


    // Sự kiện sẽ được kích hoạt khi tạo, cập nhật hoặc xóa màu sắc
    protected static function booted()
    {
        static::created(function ($colour) {
            if ($colour->product) {
                $colour->product->updateStockFromColours();
            }
        });

        static::updated(function ($colour) {
            if ($colour->product) {
                $colour->product->updateStockFromColours();
            }
        });

        static::deleted(function ($colour) {
            if ($colour->product) {
                $colour->product->updateStockFromColours();
            }
        });
    }
    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'colour_id'); 
    }
    
}
