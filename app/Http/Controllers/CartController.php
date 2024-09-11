<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    function add(){
        return view('cart.add',['products'=>Product::all()]);
    }
    public function store(Request $request)
    {

        $user = auth()->user(); // Giả sử người dùng đã đăng nhập


        $cart = Cart::Create([
            'user_id' => $user->id,
            'total_price' => 0,
            'discount_amount' => 0,
            'final_price' => 0
            ]);

        $totalPrice = 0;

        // Lặp qua các sản phẩm để thêm từng sản phẩm vào giỏ hàng
        foreach ($request->products as $productData) {
            $product = Product::find($productData['product_id']);

            // Thêm sản phẩm vào giỏ hàng
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'price' => $product->price, // Giá của sản phẩm tại thời điểm thêm
            ]);

            // Cộng dồn giá trị sản phẩm
            $totalPrice += $product->price;
        }

        // Cập nhật tổng giá trị của giỏ hàng
        $cart->total_price += $totalPrice;
        $cart->final_price = $cart->total_price - $cart->discount_amount;
        $cart->save();

        return redirect()->route('coupon.apply',['cartId'=>$cart->id]);
    }
}
