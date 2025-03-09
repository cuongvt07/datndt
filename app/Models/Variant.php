<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;
    protected $fillable = ['ram_smartphone', 'price'];
    public function product()
    {
        return $this->hasMany(product::class, 'variant_id');
    }
    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class, 'variant_id');
    }
}
