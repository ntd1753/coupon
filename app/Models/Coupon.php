<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = [
        'vendor',
        'code',                // Mã Giảm giá
        'discount_type',       // Loại giảm giá (Giảm phần trăm/Giảm giá tiền)
        'discount_amount',     // Phần trăm giảm giá/Số tiền giảm giá
        'description',         // Description of the coupon
        'minimum_purchases',   // Số đơn hàng tối thiểu đã mua
        'maximum_purchases',   // Số đơn hàng tối đa đã mua (optional)
        'minimum_price',       // Trị giá đơn hàng tối thiểu (optional)
        'maximum_spend_discount', // Giảm giá tối đa (optional)
        'start_date',          // Start Date
        'end_date',            // End Date
        'use_limit',           // Số lượt sử dụng (optional)
        'use_limit_per_user',  // Số lượt sử dụng cho mỗi khách hàng (optional)
        'multiple_use',        // Dùng cùng với các voucher khác (Yes/No)
    ];
    function couponHistories(){
        return $this->hasMany(CouponHistory::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'coupon_histories', 'coupon_id', 'user_id')
            ->withPivot('order_id', 'discount_amount', 'created_at', 'updated_at')
            ->withTimestamps();
    }
    public function scope(){
        return $this->hasMany(CouponScope::class);
    }
    public function vendor(){
        return $this->belongsTo(User::class, 'vendor_id');
    }

}
