<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    function store(Request $request){
        $post=new Post();
        $post->content=$request->input('content');
        $post->save();
        return response()->json(['content'=>$post]);
    }
    function detail($postId){
        return view('post.detail',['post'=>Post::find($postId)]);
    }

}
