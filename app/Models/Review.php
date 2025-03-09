<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'user_id', 'name', 'email', 'content', 'rating', 'images', 'videos','order_item_id',
    ];

    // Đảm bảo rằng các trường images và videos được cast từ JSON
    protected $casts = [
        'images' => 'array',
        'videos' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);  
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
