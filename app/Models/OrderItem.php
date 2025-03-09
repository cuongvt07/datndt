<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'product_id', 'quantity', 'price','variant_id', 'battery_id', 'color_id'];

   
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

  
    public function review()
    {
        return $this->hasOne(Review::class, 'order_item_id'); 
    }
    public function product()
    {
        return $this->belongsTo(Product::class);  
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
        return $this->belongsTo(Colour::class);
    }
}