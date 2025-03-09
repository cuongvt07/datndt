<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Battery extends Model
{
    use HasFactory;
    protected $table = 'batterys';
    protected $fillable =['name','capacity','price'];
}
