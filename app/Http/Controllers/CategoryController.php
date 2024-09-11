<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function add(){
        return view('category.add');
    }
    function store(Request $request){
        $category=Category::create([
            'name'=> $request->name,
        ]);
        return response()->json(['message'=>'success']);
    }
}
