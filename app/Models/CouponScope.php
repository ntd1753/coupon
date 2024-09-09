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
}
