<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\CouponHistory;
use App\Models\CouponScope;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    function add(){
        return view('coupon.add',[
            'categories'=>Category::all(),
        ]);
    }
    function store(Request $request){
            // Validate input data
            $validator = Validator::make($request->all(), [
                'code' => 'required|string|unique:coupons',
                'discount_type' => 'required|string|in:percentage,fixed',
                'discount_amount' => 'required|numeric|min:0',
                'description' => 'nullable|string',
                'minimum_purchases' => 'nullable|integer|min:0',
                'maximum_purchases' => 'nullable|integer|min:0',
                'minimum_price' => 'nullable|numeric|min:0',
                'maximum_spend_discount' => 'nullable|numeric|min:0',
                'start_date' => 'required|date|before_or_equal:end_date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'use_limit' => 'nullable|integer|min:0',
                'use_limit_per_user' => 'nullable|integer|min:0',
                'multiple_use' => 'required|in:yes,no',
                //'model_type' => 'required|string|in:category,campaigner,product',
                'model_id' => 'nullable|integer',
            ]);

            // Return validation errors if any
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            //dd($request->all());
            // Create the coupon
            $coupon = Coupon::create([
                'vendor_id'=>1,
                'code' => $request->input('code'),
                'discount_type' => $request->input('discount_type'),
                'discount_amount' => $request->input('discount_amount'),
                'description' => $request->input('description'),
                'minimum_purchases' => $request->input('minimum_purchases', 0),
                'maximum_purchases' => $request->input('maximum_purchases'),
                'minimum_price' => $request->input('minimum_price'),
                'maximum_spend_discount' => $request->input('maximum_spend_discount'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'use_limit' => $request->input('use_limit'),
                'use_limit_per_user' => $request->input('use_limit_per_user'),
                'multiple_use' => $request->input('multiple_use'),
                'total_use' => 0, // Default to 0 uses initially
            ]);
            $couponScope=CouponScope::create([
                'coupon_id'=>$coupon->id,
                'model_type'=>$request->input('scope_model_type'),
                "model_id"=>$request->input('model_id'),
            ]);
            return response()->json(['message' => 'Coupon created successfully.', 'coupon' => $coupon], 201);
        }
}
