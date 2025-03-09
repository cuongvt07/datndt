<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'image_path',
        'variant_id',
        'colour_id',
        'product_id',
    ];
    public function variants()
    {
        return $this->belongsTo(Variant::class, 'variant_id');
    }
    public function colour()
    {
        return $this->belongsTo(Colour::class, 'colour_id');
    }
    public function product()
    {
        return $this->belongsTo(product::class, 'product_id');
    }


    public function colours()
    {
        return $this->belongsToMany(Colour::class, 'product_colour'); 
    }
}
