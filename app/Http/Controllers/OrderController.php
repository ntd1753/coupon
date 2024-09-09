<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\CouponHistory;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function applyCoupon(Request $request, $orderId)
    {
        // Validate coupon code input
        $request->validate([
            'coupon_code' => 'required|string',
        ]);

        // Fetch order
        $order = Order::findOrFail($orderId);

        // Check if coupon exists
        $coupon = Coupon::where('code', $request->input('coupon_code'))->first();

        if (!$coupon) {
            return response()->json(['message' => 'Invalid coupon code.'], 404);
        }

        // Check if the coupon is still valid
        if (now()->lt($coupon->start_date) || now()->gt($coupon->end_date)) {
            return response()->json(['message' => 'Coupon expired or not valid yet.'], 400);
        }

        // Calculate discount based on the type (percentage or fixed)
        $discount = 0;
        if ($coupon->discount_type === 'percentage') {
            $discount = ($coupon->discount_amount / 100) * $order->total_price;
        } elseif ($coupon->discount_type === 'fixed') {
            $discount = min($coupon->discount_amount, $order->total_price); // Prevent discount exceeding total
        }

        // Apply the coupon's maximum spend limit
        if ($coupon->maximum_spend_discount && $discount > $coupon->maximum_spend_discount) {
            $discount = $coupon->maximum_spend_discount;
        }

        // Update order's discount and final price
        $order->discount_amount = $discount;
        $order->final_price = $order->total_price - $discount;
        $order->coupon_id = $coupon->id;
        $order->save();

        // Log coupon usage in coupon history
        CouponHistory::create([
            'user_id' => Auth::id(),
            'coupon_id' => $coupon->id,
            'order_id' => $order->id,
            'discount_amount' => $discount,
        ]);

        return response()->json(['message' => 'Coupon applied successfully.', 'discount' => $discount], 200);
    }
}
