<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'amount',
        'percentage',
        'product_id',
        'user_id',
        'usage_limit',
        'start_date',
        'end_date',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'discount_code_product', 'discount_code_id', 'product_id');
    }
    


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
