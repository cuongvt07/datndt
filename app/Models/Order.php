<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['shipping_fee','user_id', 'total_price', 'status', 'phone', 'payment_method','province','district','ward','detail_address'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

 
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    
    
    
}
