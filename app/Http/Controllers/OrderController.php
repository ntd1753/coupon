<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\CouponHistory;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function showOrder($cartId){

        //dd(count(Cart::find($cartId)->CartItem->toArray()));
        return view('order',["cart"=>Cart::find($cartId)]);
    }
    public function applyCoupon(Request $request, $cartId)
    {

        $request->validate([
            'coupon_code' => 'required|string',
        ]);
        $cart = Cart::find($cartId);
        $coupon = Coupon::where('code', $request->input('coupon_code'))->first();
        // check có tồn tại ko
        if (!$coupon) {
            return response()->json(['message' => 'Invalid coupon code.'], 404);
        }
        //check hsd
        if (now()->lt($coupon->start_date) || now()->gt($coupon->end_date)) {
            return response()->json(['message' => 'Coupon expired or not valid yet.'], 400);
        }
        //check lượt sử dụng

        $couponUsedCount=CouponHistory::where('coupon_id',$coupon->id)->where('user_id',Auth::user()->id)->count();
        if (($coupon->use_limit - $coupon->total_use)==0 || $coupon->use_limit_per_user==$couponUsedCount){
            return response()->json(['message' => 'Coupon expired or not valid yet.'], 400);
        }
        //check số đơn mua
        if ($coupon->minimum_purchases>Auth::user()->orders()->count()){
            return response()->json(['message' => 'not eligible to use coupon'], 400);
        }
        //check giớ hạn giá trị đơn
        if ($coupon->minimum_price>$cart->total_price){
            return response()->json(['message' => 'not eligible to use coupon'], 400);
        }
        //check phạm vi của coupon
        // Kiểm tra phạm vi của coupon
        if ($coupon->scope()->exists()) {
            // Kiểm tra nếu phạm vi là 'category'
            if ($coupon->scope()->first()->model_type == 'category') {
                // Lấy tất cả cartItems trong giỏ hàng
                $cartItems = $cart->cartItem; // Lấy các CartItem
                // Duyệt qua từng CartItem
                foreach ($cartItems as $cartItem) {
                    // Kiểm tra nếu 'category_id' của cartItem không khớp với 'model_id' của scope
                    $modelIds = $coupon->scope()->pluck('model_id');
                    $count=0;
                    foreach ($modelIds as $modelId){
                        if ($cartItem->category_id==$modelId){
                            $count++;
                        }
                    }
                    if ($count==0){
                        return response()->json(['message' => $cartItem->product->name.'not eligible to use coupon'], 400);
                    }
                }
            }
            elseif ($coupon->scope()->first()->model_type == 'product') {
                // Lấy tất cả cartItems trong giỏ hàng
                $cartItems = $cart->cartItem; // Lấy các CartItem
                // Duyệt qua từng CartItem
                foreach ($cartItems as $cartItem) {
                    // Kiểm tra nếu 'category_id' của cartItem không khớp với 'model_id' của scope
                    $modelIds = $coupon->scope()->pluck('model_id');
                    $count=0;
                    foreach ($modelIds as $modelId){
                        if ($cartItem->product_id==$modelId){
                            $count++;
                        }
                    }
                    if ($count==0){
                        return response()->json(['message' => $cartItem->product->name.'not eligible to use coupon'], 400);
                    }
                }
            }
        }

        if ($coupon->vendor->hasRole('agency')){
            $productIdOfVendors=$coupon->vendor->products()->pluck('id');
            $cartItems = $cart->cartItem;
            foreach ($cartItems as $cartItem) {
                // Kiểm tra nếu 'category_id' của cartItem không khớp với 'model_id' của scope
                $count=0;
                foreach ($productIdOfVendors as $productIdOfVendor){
                    if ($cartItem->product_id==$productIdOfVendor){
                        $count++;
                    }
                }
                if ($count==0){
                    return response()->json(['message' => $cartItem->product->name.'not eligible to use coupon'], 400);
                }
            }
            //dd($productIdOfVendor);
        }

        //check kiểu giảm giá
        $discount = 0;
        if ($coupon->discount_type == 'percentage') {
            $discount = ($coupon->discount_amount / 100) * $cart->total_price;
        }
        elseif ($coupon->discount_type == 'fixed') {
            $discount = min($coupon->discount_amount, $cart->total_price);
        }
        //check giới hạn giảm giá
        if ($discount > $coupon->maximum_spend_discount) {
            $discount = $coupon->maximum_spend_discount;
        }
        // Update order's discount and final price
        $cart->discount_amount = $discount;
        $cart->final_price = $cart->total_price - $discount;
        $cart->save();

        return response()->json(['message' => 'Coupon applied successfully.', 'discount' => $discount], 200);
    }
}
