<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponScope extends Model
{
    use HasFactory;
    protected $fillable=[
        'coupon_id',
        'model_type',
        'model_id',
    ];
    public function category()
    {
        return $this->hasOne(Category::class, "id","model_id");
    }
    public function product()
    {
        return $this->hasOne(Product::class, "id","model_id");
    }
}
