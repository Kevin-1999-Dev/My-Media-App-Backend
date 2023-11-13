<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function show(){
        $posts = Post::get();
        return response()->json([
            'status' => 'success',
            'posts' => $posts,
        ]);
    }
    public function search(Request $request){

       $post = Post::where('title','LIKE','%'.$request->key.'%')->get();
        return response()->json([
            'post' => $post
        ]);
    }
    public function detail(Request $request){
        $post = Post::where('post_id',$request->key)->first();

        return response()->json([
            'post' => $post
        ]);
    }
}
