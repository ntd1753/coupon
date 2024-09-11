<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    function add(){
        return view('product.add',['categories'=>Category::all()]);
    }
    function store(Request $request){

            // Xác nhận dữ liệu gửi lên từ form
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'price' => 'required|numeric',
            ]);

            // Tạo sản phẩm mới
            $product = Product::create([
                'name' => $validatedData['name'],
                'vendor_id' => Auth::user()->id,
                'category_id' => $validatedData['category_id'],
                'price' => $validatedData['price'],
            ]);

            // Trả về thông báo thành công
            return response()->json([
                'message' => 'success',
                'product' => $product,
            ], 201);

    }
}
