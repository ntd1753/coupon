<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'cart_id',
        'price',
    ];
    function product(){
        return $this->hasOne(Product::class,'id','product_id');
    }
}
