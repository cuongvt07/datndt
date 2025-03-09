<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $fillable = ['cart_id', 'product_id', 'battery_id', 'variant_id', 'color_id', 'quantity'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
    public function battery()
    {
        return $this->belongsTo(Battery::class);
    }

    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }

    public function color()
    {
        return $this->belongsTo(Colour::class, 'color_id');
    }
    
}
