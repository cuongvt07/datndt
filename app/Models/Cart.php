<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['user_id'];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function getTotalAmount()
    {
        return $this->cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
    }
    public function items()
    {
        return $this->hasMany(CartItem::class); // hoặc tên class tương ứng với các mục trong giỏ hàng
    }
    
}
