<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_sp',
        'image',
        'description',
        'price',
        'stock',
        'variant_id',
        'category_id',
        'supplier_id',
        'battery_id',
        'colour_id',
        'screen_id',
        'is_active',
    ];

    public function variant()
    {
        return $this->belongsTo(Variant::class, 'variant_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
    


    public function battery()
    {
        return $this->belongsTo(Battery::class, 'battery_id');
    }

    public function colours()
    {
        return $this->hasMany(Colour::class, 'product_id');
    }


    public function screen()
    {
        return $this->belongsTo(Screen::class, 'screen_id');
    }
    public function getTotalColourQuantityAttribute()
    {
        return $this->colours->sum('quantity') ?? 0;
    }

    public function updateStockFromColours()
    {
        // Tính tổng số lượng từ các màu liên quan đến sản phẩm, nếu không có màu thì gán stock bằng 0
        $totalQuantity = $this->colours->sum('quantity') ?? 0;

        // Cập nhật cột stock với tổng số lượng này
        $this->stock = $totalQuantity;
        $this->save();
    }
    public function discountCodes()
    {
        return $this->belongsToMany(DiscountCode::class, 'discount_code_product', 'product_id', 'discount_code_id');
    }
    public function getTotalColourQuantity()
    {

        return $this->stock;
    }
    public function getTotalColourQuantityById($colourId)
    {

        return $this->colours()
            ->where('id', $colourId)
            ->sum('quantity');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }

   



    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }

    public function totalSold()
    {
        return $this->orderItems()
            ->whereHas('order', function ($query) {
                $query->where('status', 'completed');
            })
            ->sum('quantity');
    }
    public function totalReviews()
    {
        return $this->reviews()->count();
    }
    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'wishlists', 'product_id', 'user_id')->withTimestamps();
    }
    

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }
}
